<?php

namespace App\Http\Controllers;

use App\Repositories\Game\Game;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = Auth::user()->game;
        return view('home')->with(['game' => $game]);
    }
}
