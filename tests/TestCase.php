<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Repositories\Game\Game;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function loadGame($user)
    {
        $game = Game::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'promotion_id' => 1,
            'promoter_name' => 'Vince McMahon'
        ]);

        session(['game_id' => $game->id, 'game' => $game]);
        return $game->id;
    }
}
