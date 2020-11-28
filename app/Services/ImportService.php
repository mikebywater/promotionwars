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
          //          $data['promotion_id'] = 1;
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
                case 6:
                    $data['draw'] = $line;
                    break;
                case 7:
                    $data['ability'] = $line;
                    break;
                case 8:
                    $data['bio'] = htmlentities($line);
                    break;
                case 15:
                    $data['disposition'] = $line;
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
                    $data['promotion_id'] = 1;
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
}
