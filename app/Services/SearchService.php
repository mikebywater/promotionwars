<?php

namespace App\Services;

use App\Contracts\WrestlerRepository;

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