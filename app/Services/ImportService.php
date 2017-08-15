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

    public function importWrestlers($file)
    {
        $i = 1;
        $data = array();
        foreach (file($file) as $line) {
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
                    $data['age'] = 60 - (int)$line;
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
                    $data['game_id'] = 1;
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