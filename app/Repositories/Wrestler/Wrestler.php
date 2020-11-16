<?php

namespace App\Repositories\Wrestler;

use App\Scopes\GameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wrestler extends Model
{
    use HasFactory;

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
