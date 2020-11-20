<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('user_id', Auth::user()->id);
    }
}
