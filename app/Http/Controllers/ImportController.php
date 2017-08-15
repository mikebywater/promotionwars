<?php

namespace App\Http\Controllers;

use App\Services\ImportService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    protected $service;

    public function __construct(ImportService $service)
    {
        $this->service = $service;
    }

    public function importWrestlers(Request $request)
    {
        $this->service->importWrestlers($request->file('file'));

        return redirect('home');
    }
}
