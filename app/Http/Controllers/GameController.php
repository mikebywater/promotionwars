<?php

namespace App\Http\Controllers;

use App\Repositories\Game\Game;
use App\Repositories\Promotion\Promotion;
use App\Services\ImportService;
use Illuminate\Http\Request;
use App\Contracts\PromotionRepository;
use App\Contracts\GameRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GameController extends Controller
{

    protected $repository;
    protected $promotionRepository;
    /**
     * @var ImportService
     */
    private $importService;


    public function __construct(GameRepository $repository, PromotionRepository $promotionRepository, ImportService $importService)
    {
        $this->repository = $repository;
        $this->promotionRepository = $promotionRepository;
        $this->importService = $importService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (session('game_id')) {
            return redirect('/home');
        }

        return view('welcome')->with(['games' => Game::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Next Day
        $game = Game::find($id);
        $game->update($request->all());
        $promotion = $game->promotion;
        session(['game' => $game, 'promotion' => $promotion]);
        return redirect("/home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $promotions = $this->promotionRepository->all();
        return view('games.create')->with(['promotions' => $promotions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        if($request->has('game_id')){
            session(['game_id' => $request->game_id]);
            $game = Game::find($request->game_id);
            $promotion = $game->promotion;
            session(['game' => $game, 'promotion' => $promotion]);
            return redirect('/home');
        }

        $id = Str::uuid();

        session(['game_id' => $id]);

        if ($request->hasFile('promotions-file')) {
            $this->importService->importPromotions($request->file('promotions-file'), $id);
        }

        if ($request->hasFile('wrestlers-file')) {
            $this->importService->importWrestlers($request->file('wrestlers-file'), $id);
        }

        $request->request->set('user_id', Auth::user()->id);
        $request->request->set('id', $id);


        $game = $this->repository->create( $request->except(['promotions-file' , 'wrestlers-file']));


        session(['game' => $game]);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function load()
    {
        return view('games.load')->with(['games' => $this->repository->all()]);
    }

    public function exit()
    {
        session(['game_id' => '']);
        session(['game' => '']);
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}
