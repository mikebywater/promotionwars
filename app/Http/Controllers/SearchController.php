<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $service;

    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if (! $request->has('q')) {
            return redirect('/');
        }

        $searchTerm = $request->get('q');

        return view('search.index', array(
            'searchTerm' => $searchTerm,
            'results' => $this->service->search($searchTerm)
        ));
    }
}
