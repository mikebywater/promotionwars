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

    public function findByShortName($name)
    {
        return $this->model->where('short_name' , $name)->first();
    }
}
