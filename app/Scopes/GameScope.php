<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class GameScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('game_id' , Session::get('game_id') );
    }

}