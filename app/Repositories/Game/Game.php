<?php

namespace App\Repositories\Game;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $guarded = [];


    public function getCarbonDateAttribute()
    {
        return Carbon::parse($this->game_date);
    }
}
