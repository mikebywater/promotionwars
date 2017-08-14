<?php

namespace App\Repositories\Wrestler;

use App\Scopes\GameScope;
use Illuminate\Database\Eloquent\Model;

class Wrestler extends Model
{
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GameScope());
    }


    public function promotion()
    {
        return $this->belongsTo('App\Repositories\Promotion\Promotion');
    }
}
