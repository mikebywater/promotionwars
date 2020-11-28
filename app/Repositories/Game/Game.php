<?php

namespace App\Repositories\Game;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Game extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

    public function getCarbonDateAttribute()
    {
        return Carbon::parse($this->game_date);
    }

}
