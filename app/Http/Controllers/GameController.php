<?php

namespace App\Http\Controllers;

use App\Repositories\Game\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return "";
    }

    public function update(Request $request, $id)
    {
        // Next Day
        $game = Game::find($id);
        $game->game_date = $request->game_date;
        $game->save();
        return redirect("/home");
    }
}
