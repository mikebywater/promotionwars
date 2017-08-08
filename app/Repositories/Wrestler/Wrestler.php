<?php

namespace App\Repositories\Wrestler;
use Illuminate\Database\Eloquent\Model;

class Wrestler extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GameScope);
    }
}
