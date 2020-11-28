<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoadedGame
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(session('game_id'))) {
            return redirect('/');
        }

        return $next($request);
    }
}
