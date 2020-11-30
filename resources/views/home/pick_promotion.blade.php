@extends('layouts.master')

@section('content')

<div class="col-md-4">
     {{$game->carbon_date->format('d/m/Y')}}
        <form method="POST" action="/games/{{session('game_id')}}">
            @method('put')
            @csrf
            <select class="form-control" id="promotion" name="promotion_id">
                @foreach ($promotions as $promotion)
                    <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary">Choose</button>
        </form>

</div>


@endsection
