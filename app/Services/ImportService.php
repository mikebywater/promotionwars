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

    public function createWrestler($data)
    {
        $data = array(
            'name' => 'Rob Van Dam',
            'draw' => 68,
            'ability' => 88,
            'charisma' => 90,
            'mic_skills' => 70,
            'condition' => 100,
            'hardcore' => 88,
            'disposition' => 'Face',
            'promotion_id' => 1,
            'game_id' => 1,
            'age' => 46,
            'bio' => 'The Whole effing show',
            'style' => 'Technical',
            'weight' => 'Light',
            'role' => 'Midcard',
        );

        $this->wrestlerRepository->create($data);
    }

}