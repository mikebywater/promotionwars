<?php

namespace App\Services;

use App\Contracts\WrestlerRepository;
use App\Repositories\User\User;

class SearchService
{
    protected $wrestlerRepository;

    public function __construct(WrestlerRepository $wrestlerRepository)
    {
        $this->wrestlerRepository = $wrestlerRepository;
    }

    public function search($searchTerm)
    {
        return $this->wrestlerRepository->search($searchTerm);
    }
}
