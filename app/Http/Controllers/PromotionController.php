<?php

namespace App\Http\Controllers;

use App\Contracts\PromotionRepository;

class PromotionController extends Controller
{
    protected $repo;

    public function __construct(PromotionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $promotions = $this->repo->all();
        return view('promotions.index')->with(['promotions' => $promotions]);
    }

    public function show($id)
    {
        $promotion = $this->repo->find($id);
        return view('promotions.show')->with(['promotion' => $promotion]);
    }
}
