<?php

namespace App\Http\Controllers;

use App\Repositories\Game\Game;
use Illuminate\Http\Request;
use App\Contracts\PromotionRepository;
use App\Contracts\GameRepository;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    protected $repository;
    protected $promotionRepository;


    public function __construct(GameRepository $repository, PromotionRepository $promotionRepository)
    {
        $this->repository = $repository;
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('game_id')) {
            return redirect('/home');
        }

        return view('welcome');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Next Day
        $game = Game::find($id);
        $game->game_date = $request->game_date;
        $game->save();
        return redirect("/home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = $this->promotionRepository->all();
        return view('games.create')->with(['promotions' => $promotions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('game_id')) {
            $game = $this->repository->find($request->get('game_id'));

            if ($game) {
                session(['game_id' => $game->id]);
                return redirect('/home');
            }
        }

        $request->request->set('user_id', Auth::user()->id);

        $game = $this->repository->create(
            $request->all()
        );

        session(['game_id' => $game->id]);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function load()
    {
        return view('games.load')->with(['games' => $this->repository->all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
