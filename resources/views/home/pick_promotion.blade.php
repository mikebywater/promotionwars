@extends('layouts.master')

@section('page-title', 'Pick Promotion')

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block">
                        <div class="title"><strong>Select Your Promotion</strong></div>
                        <div class="block-body">
                            <p>Current Date: {{$game->carbon_date->format('l jS M Y')}}</p>
                            <form method="POST" action="/games/{{session('game_id')}}">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="promotion">Promotion</label>
                                    <select class="form-control" id="promotion" name="promotion_id">
                                        @foreach ($promotions as $promotion)
                                            <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary">Choose</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
