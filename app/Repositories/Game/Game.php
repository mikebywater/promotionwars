<?php

namespace App\Repositories\Game;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Game extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }
}
