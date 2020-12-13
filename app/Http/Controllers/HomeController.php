<?php

namespace App\Http\Controllers;

use App\Contracts\PromotionRepository;
use App\Repositories\Game\Game;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var PromotionRepository
     */
    private $promotionRepository;

    /**
     * Create a new controller instance.
     *
     * @param PromotionRepository $promotionRepository
     */
    public function __construct(PromotionRepository $promotionRepository)
    {
        $this->middleware('auth');
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = Game::find(session('game_id'));
        $promotions = $this->promotionRepository->all();
        if($game->promotion){
            return view('home.dashboard')->with(['game' => $game, 'promotions' => $promotions]);
        }else{
            return view('home.pick_promotion')->with(['game' => $game, 'promotions' => $promotions]);
        }

    }
}
