<?php

namespace App\Repositories\Game;

use App\Contracts\GameRepository as GameRepositoryContract;
use App\Repositories\Repository;

class GameRepository extends Repository implements GameRepositoryContract
{
    public function __construct()
    {
        $this->model = new Game();
    }
}
