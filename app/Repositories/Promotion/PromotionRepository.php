<?php

namespace App\Repositories\Promotion;

use App\Contracts\PromotionRepository as PromotionRepositoryContract;
use App\Repositories\Repository;

class PromotionRepository extends Repository implements PromotionRepositoryContract
{
    public function __construct()
    {
        $this->model = new Promotion();
    }
}
