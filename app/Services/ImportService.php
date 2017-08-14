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

}