<?php

namespace App\Repositories\Promotion;

use App\Scopes\GameScope;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GameScope());
    }

}
