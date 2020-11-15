<?php

namespace App\Http\Controllers;

use App\Repositories\Wrestler\WrestlerRepository;

class WrestlerController extends Controller
{
    protected $repo;

    public function __construct(WrestlerRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $wrestlers = $this->repo->all();

        return view('wrestlers.index')->with(['wrestlers' => $wrestlers]);
    }

    public function show($id)
    {
        $wrestler = $this->repo->find($id);

        return view('wrestlers.show')->with(['wrestler' => $wrestler]);
    }
}
