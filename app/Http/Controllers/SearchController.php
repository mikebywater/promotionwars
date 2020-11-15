<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $service;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if (!$request->has('q')) {
            return redirect('/');
        }

        $searchTerm = $request->get('q');

        return view('search.index', [
            'searchTerm' => $searchTerm,
            'results'    => $this->service->search($searchTerm),
        ]);
    }
}
