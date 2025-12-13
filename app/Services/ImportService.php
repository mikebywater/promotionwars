<?php

namespace App\Services;

use App\Contracts\PromotionRepository;
use App\Contracts\WrestlerRepository;

class ImportService
{
    protected $promotionRepository;
    protected $wrestlerRepository;

    public function __construct(WrestlerRepository $wrestlerRepository, PromotionRepository $promotionRepository)
    {
        $this->wrestlerRepository = $wrestlerRepository;
        $this->promotionRepository = $promotionRepository;
    }

    public function importPromotions($file, $id)
    {
        $i = 1;
        $data = [];
        foreach (file($file) as $line) {
            $line = trim($line);
            switch ($i) {
                case 1:
                    $data['short_name'] = $line;
                    break;
                case 2:
                    $data['name'] = $line;
                    break;
                case 4:
                    $data['size'] = $line;
                    break;
                case 5:
                    $data['funds'] = $line;
                    break;
                case 6:
                    $data['website'] = $line;
                    break;
                case 7:
                    $data['bio'] = htmlentities($line);
                    break;
                case 46:
                    $data['popularity'] = $line;
                    break;
                case 238:
                    $i = 0;
                    $data['game_id'] = $id;
                    $this->promotionRepository->create($data);
                    $data = [];
                    break;
            }
            $i++;
        }
    }

    public function importWrestlers($file, $id)
    {
        $i = 1;
        $data = [];
        foreach (file($file) as $line) {
            $line = trim($line);
            switch ($i) {
                case 1:
                    $data['name'] = $line;
                    break;
                case 3:
                    $promotion = $this->promotionRepository->findByShortName(trim($line));
                    $data['promotion_id'] = ($promotion ? $promotion->id : null) ;
                    break;
                case 6:
                    $data['draw'] = $line;
                    break;
                case 7:
                    $data['ability'] = $line;
                    break;
                case 8:
                    $data['bio'] = htmlentities($line);
                    break;
                case 12:
                    $data['salary'] = htmlentities($line); // monthly salary
                    break;
                case 15:
                    $data['disposition'] = $line;
                    break;
                case 16:
                    $data['finisher'] = $line;
                    break;
                case 22:
                    $data['condition'] = $line;
                    break;
                case 24:
                    $data['style'] = $line;
                    break;
                case 26:
                    $data['age'] = 60 - (int) $line;
                    break;
                case 27:
                    $data['mic_skills'] = $line;
                    break;
                case 28:
                    $data['hardcore'] = $line;
                    break;
                case 29:
                    $data['weight'] = $line;
                    break;
                case 30:
                    $data['charisma'] = $line;
                    break;
                case 31:
                    $i = 0;
                    $data['game_id'] = $id;
                    $data['role'] = 'Midcard';
                    $this->wrestlerRepository->create($data);
                    $data = [];
                    break;
            }
            $i++;
        }

        return 'done';
    }

    /**
     * Import from a zip file (new format)
     * Extracts the zip to a temporary directory, imports, then cleans up
     * 
     * @param string|\Illuminate\Http\UploadedFile $zipFile Path to zip file or uploaded file
     * @param string $id Game ID
     * @return void
     */
    public function importDataPackFromZip($zipFile, $id)
    {
        // Handle both file paths and uploaded files
        $zipPath = is_string($zipFile) ? $zipFile : $zipFile->getRealPath();
        
        if (!file_exists($zipPath)) {
            throw new \Exception("Zip file not found: {$zipPath}");
        }

        // Create temporary directory for extraction
        $tempDir = sys_get_temp_dir() . '/pw_import_' . uniqid();
        if (!mkdir($tempDir, 0755, true)) {
            throw new \Exception("Failed to create temporary directory: {$tempDir}");
        }

        try {
            // Extract zip file
            $zip = new \ZipArchive();
            if ($zip->open($zipPath) !== TRUE) {
                throw new \Exception("Failed to open zip file: {$zipPath}");
            }

            $zip->extractTo($tempDir);
            $zip->close();

            // Import from extracted directory
            $this->importDataPack($tempDir, $id);
        } finally {
            // Clean up temporary directory
            $this->deleteDirectory($tempDir);
        }
    }

    /**
     * Recursively delete a directory
     * 
     * @param string $dir Directory path
     * @return void
     */
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }

    /**
     * Recursively find files by pattern
     * 
     * @param string $directory Starting directory
     * @param string $pattern File pattern (e.g., '*.fed')
     * @return array Array of file paths
     */
    private function findFilesRecursive($directory, $pattern)
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $file) {
            if ($file->isFile() && fnmatch($pattern, $file->getFilename())) {
                $files[] = $file->getPathname();
            }
        }
        
        return $files;
    }

    /**
     * Import from a data pack directory (new format)
     * 
     * @param string $directory Path to the data pack directory
     * @param string $id Game ID
     * @return void
     */
    public function importDataPack($directory, $id)
    {
        // First try root directory
        $wrestlersFile = $directory . '/wrestlers.pw1';
        $fedFiles = glob($directory . '/*.fed');
        
        // If no files found in root, search recursively
        if (empty($fedFiles)) {
            $fedFiles = $this->findFilesRecursive($directory, '*.fed');
        }
        
        // Import all .fed files (promotions) first
        foreach ($fedFiles as $fedFile) {
            $this->importPromotionFromFed($fedFile, $id);
        }

        // Find wrestlers.pw1 file
        if (!file_exists($wrestlersFile)) {
            $wrestlersFiles = $this->findFilesRecursive($directory, 'wrestlers.pw1');
            if (!empty($wrestlersFiles)) {
                $wrestlersFile = $wrestlersFiles[0];
            }
        }
        
        if (file_exists($wrestlersFile)) {
            $this->importWrestlersFromPw1($wrestlersFile, $id);
        }
    }

    /**
     * Import a single promotion from a .fed file (new format)
     * 
     * @param string $file Path to .fed file
     * @param string $id Game ID
     * @return void
     */
    public function importPromotionFromFed($file, $id)
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        if (empty($lines)) {
            return;
        }

        $data = [];
        $data['short_name'] = isset($lines[0]) ? trim($lines[0]) : '';
        $data['name'] = isset($lines[1]) ? trim($lines[1]) : '';
        $data['size'] = isset($lines[3]) ? (int)trim($lines[3]) : 0;
        $data['funds'] = isset($lines[4]) ? (float)trim($lines[4]) : 0;
        
        // Clean website URL (remove tags like <PS1LEN=1><UNLPS2>)
        $website = isset($lines[5]) ? trim($lines[5]) : '';
        $website = preg_replace('/<[^>]+>/', '', $website);
        $data['website'] = $website;
        
        $data['bio'] = isset($lines[6]) ? htmlentities(trim($lines[6])) : '';
        
        // Popularity can be at line 18 (index 17), 46 (index 45), or 48 (index 47)
        // Based on WWF.fed, line 18 (index 17) = 71, line 46 (index 45) = 86, line 48 (index 47) = 90.0001
        // Use line 48 (index 47) as it seems to be the most accurate
        $popularity = 0;
        if (isset($lines[47]) && is_numeric(trim($lines[47]))) {
            $popularity = (float)trim($lines[47]);
        } elseif (isset($lines[45]) && is_numeric(trim($lines[45]))) {
            $popularity = (float)trim($lines[45]);
        } elseif (isset($lines[17]) && is_numeric(trim($lines[17]))) {
            $popularity = (float)trim($lines[17]);
        }
        $data['popularity'] = $popularity;
        
        $data['game_id'] = $id;
        
        $this->promotionRepository->create($data);
    }

    /**
     * Import wrestlers from wrestlers.pw1 file (new format)
     * Each wrestler is 32 lines
     * 
     * @param string $file Path to wrestlers.pw1 file
     * @param string $id Game ID
     * @return void
     */
    public function importWrestlersFromPw1($file, $id)
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        $totalLines = count($lines);
        
        // Each wrestler is 32 lines
        for ($i = 0; $i < $totalLines; $i += 32) {
            if ($i + 31 >= $totalLines) {
                break; // Not enough lines for a complete wrestler
            }
            
            $data = [];
            $name = isset($lines[$i]) ? trim($lines[$i]) : '';
            
            // Skip if name is empty
            if (empty($name)) {
                continue;
            }
            
            // Verify this is a wrestler entry by checking if line 32 (index 31) matches the name
            $endMarker = isset($lines[$i + 31]) ? trim($lines[$i + 31]) : '';
            if ($endMarker !== $name) {
                // Not a valid wrestler entry, skip
                continue;
            }
            
            $data['name'] = $name;
            
            // Line 4 (index 3): promotion short name
            $promotionShortName = isset($lines[$i + 3]) ? trim($lines[$i + 3]) : '';
            if (!empty($promotionShortName) && $promotionShortName !== 'Free Agent') {
                // Find promotion without global scope to ensure we get the right one for this game
                $promotion = \App\Repositories\Promotion\Promotion::withoutGlobalScopes()
                    ->where('short_name', $promotionShortName)
                    ->where('game_id', $id)
                    ->first();
                $data['promotion_id'] = $promotion ? $promotion->id : null;
            } else {
                $data['promotion_id'] = null;
            }
            
            // Based on analysis of main eventers (Hulk Hogan, Ricky Steamboat, Sting):
            // Line 7 has very high values (97, 80, 84) - these should be DRAW for main eventers
            // Line 8 has varying values (71, 97, 90) - these should be ABILITY
            // The new format appears to have swapped the order from old format
            // Line 7 = draw (main eventers have 80-97 here)
            // Line 8 = ability (varies more, 71-97)
            $data['draw'] = isset($lines[$i + 6]) ? (int)trim($lines[$i + 6]) : 0;
            $data['ability'] = isset($lines[$i + 7]) ? (int)trim($lines[$i + 7]) : 0;
            
            // Line 9 (index 8): bio
            $data['bio'] = isset($lines[$i + 8]) ? htmlentities(trim($lines[$i + 8])) : '';
            
            // Line 16 (index 15): disposition
            $data['disposition'] = isset($lines[$i + 15]) ? trim($lines[$i + 15]) : '';
            
            // Line 17 (index 16): finisher
            $data['finisher'] = isset($lines[$i + 16]) ? trim($lines[$i + 16]) : '';
            
            // Line 23 (index 22): condition
            $data['condition'] = isset($lines[$i + 22]) ? (int)trim($lines[$i + 22]) : 100;
            
            // Line 25 (index 24): style
            $data['style'] = isset($lines[$i + 24]) ? trim($lines[$i + 24]) : '';
            
            // Line 27 (index 26): age
            $data['age'] = isset($lines[$i + 26]) ? (int)trim($lines[$i + 26]) : 0;
            
            // Line 28 (index 27): mic_skills (was old line 27, shifted by 1 due to alias/image)
            $data['mic_skills'] = isset($lines[$i + 27]) ? (int)trim($lines[$i + 27]) : 0;
            
            // Line 29 (index 28): hardcore (was old line 28, shifted by 1)
            $data['hardcore'] = isset($lines[$i + 28]) ? (int)trim($lines[$i + 28]) : 0;
            
            // Line 30 (index 29): weight (was old line 29, shifted by 1)
            $data['weight'] = isset($lines[$i + 29]) ? trim($lines[$i + 29]) : '';
            
            // Line 31 (index 30): charisma (was old line 30, shifted by 1)
            $data['charisma'] = isset($lines[$i + 30]) ? (int)trim($lines[$i + 30]) : 0;
            
            $data['game_id'] = $id;
            $data['role'] = 'Midcard';
            $data['salary'] = null; // Not in new format
            
            $this->wrestlerRepository->create($data);
        }
    }
}
