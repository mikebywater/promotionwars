@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if($game)
                        {{$game->carbon_date->format('d/m/Y')}}
                        <form method="POST">
                            @method('put')
                            @csrf
                            <input name= "game_date" type="hidden" value="{{$game->carbon_date->addDay()}}">
                            <button class="btn btn-primary" href="/games/create">Next Day</button>
                        </form>

                    @else
                        <a class="btn btn-primary" href="/games/create">Create Game</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
