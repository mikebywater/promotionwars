<?php

namespace App\Contracts;

interface GameRepository
{
    public function all();

    public function find($id);
}
