@extends('layouts.master')

@section('content')

@if($game)
    {{$game->carbon_date->format('d/m/Y')}}
    <form method="POST" action="/games/{{session('game_id')}}">
        @method('put')
        @csrf
        <input name= "game_date" type="hidden" value="{{$game->carbon_date->addDay()}}">
        <button class="btn btn-primary">Next Day</button>
    </form>

@else
    <a class="btn btn-primary" href="/games/create">Create Game</a>
@endif


@endsection
