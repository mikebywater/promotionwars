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

    public function uploadWrestlers()
    {
        return view('wrestlers.upload');
    }

    public function importWrestlers(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->service->importWrestlers($request->file('file'));
        }

        return redirect('wrestlers');
    }

    public function uploadPromotions()
    {
        return view('promotions.upload');
    }

    public function importPromotions(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->service->importPromotions($request->file('file'));
        }
        
        return redirect('promotions');
    }
}
