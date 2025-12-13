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
use Carbon\Carbon;

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
        $oldDate = Carbon::parse($game->game_date);
        
        // Update the game date
        $game->update($request->all());
        
        // Reload to get the new date
        $game->refresh();
        $newDate = Carbon::parse($game->game_date);
        
        // Check if the month has changed
        if ($oldDate->month != $newDate->month || $oldDate->year != $newDate->year) {
            // Month has changed - deduct salaries
            $promotion = $game->promotion;
            
            if ($promotion) {
                // Get all wrestlers for this promotion and sum their salaries
                $totalSalaries = $promotion->wrestlers()
                    ->whereNotNull('salary')
                    ->sum('salary');
                
                // Subtract total salaries from promotion funds (can go negative)
                $promotion->funds = $promotion->funds - $totalSalaries;
                $promotion->save();
                
                // Reload promotion to get updated funds
                $promotion->refresh();
            }
        } else {
            // Just get the promotion without salary deduction
            $promotion = $game->promotion;
        }
        
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

        // Check if data pack zip file is provided (new format)
        if ($request->hasFile('data-pack-zip')) {
            $zipFile = $request->file('data-pack-zip');
            
            // Validate it's a zip file
            if ($zipFile->getClientOriginalExtension() !== 'zip' && $zipFile->getMimeType() !== 'application/zip') {
                return redirect()->back()->withErrors(['data-pack-zip' => 'Please upload a valid zip file.']);
            }
            
            try {
                $this->importService->importDataPackFromZip($zipFile, $id);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['data-pack-zip' => 'Error importing data pack: ' . $e->getMessage()]);
            }
        } else {
            // Old format: individual files
            if ($request->hasFile('promotions-file')) {
                $this->importService->importPromotions($request->file('promotions-file'), $id);
            }

            if ($request->hasFile('wrestlers-file')) {
                $this->importService->importWrestlers($request->file('wrestlers-file'), $id);
            }
        }

        $request->request->set('user_id', Auth::user()->id);
        $request->request->set('id', $id);


        $game = $this->repository->create( $request->except(['promotions-file' , 'wrestlers-file', 'data-pack-zip']));


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

    /**
     * Test method to import data pack
     * 
     * @param Request $request
     * @return Response
     */
    public function testImportDataPack(Request $request)
    {
        $zipFile = $request->file('zip_file');
        
        if (!$zipFile) {
            // Fallback to directory if provided
            $directory = $request->input('directory', base_path('PW Archive (1992 - January)'));
            
            if (!is_dir($directory)) {
                return response()->json(['error' => 'Please provide a zip file or valid directory path'], 400);
            }

            $id = Str::uuid();
            
            try {
                $this->importService->importDataPack($directory, $id);
                
                $promotionsCount = $this->promotionRepository->all()->where('game_id', $id)->count();
                $wrestlersCount = \App\Repositories\Wrestler\Wrestler::withoutGlobalScopes()
                    ->where('game_id', $id)
                    ->count();
                
                return response()->json([
                    'success' => true,
                    'game_id' => $id,
                    'promotions_imported' => $promotionsCount,
                    'wrestlers_imported' => $wrestlersCount,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            }
        }

        $id = Str::uuid();
        
        try {
            $this->importService->importDataPackFromZip($zipFile, $id);
            
            $promotionsCount = $this->promotionRepository->all()->where('game_id', $id)->count();
            $wrestlersCount = \App\Repositories\Wrestler\Wrestler::withoutGlobalScopes()
                ->where('game_id', $id)
                ->count();
            
            return response()->json([
                'success' => true,
                'game_id' => $id,
                'promotions_imported' => $promotionsCount,
                'wrestlers_imported' => $wrestlersCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
