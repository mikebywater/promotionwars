<?php

namespace App\Repositories\Wrestler;

use App\Contracts\WrestlerRepository as WrestlerRepositoryContract;
use App\Repositories\Repository;

class WrestlerRepository extends Repository implements WrestlerRepositoryContract
{
    public function __construct()
    {
        $this->model = new Wrestler();
    }

    public function search($searchTerm)
    {
        return $this->model->where('name', 'like', '%' . $searchTerm . '%')->get();
    }

}