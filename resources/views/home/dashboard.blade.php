@extends('layouts.master')

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fa fa-users"></i></div><strong>Roster Size</strong>
                            </div>
                            <div class="number dashtext-1">{{$game->promotion->wrestlers->count()}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-chart"></i></div><strong>Popularity</strong>
                            </div>
                            <div class="number dashtext-2">{{$game->promotion->popularity}}%</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fa fa-dollar"></i></div><strong>Balance</strong>
                            </div>
                            <div class="number dashtext-3">{{number_format($game->promotion->funds)}} </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fa fa-calendar"></i></div><strong>{{$game->carbon_date->format('l jS  M Y')}}</strong>
                            </div>
                            <form method="POST" action="/games/{{session('game_id')}}">
                                @method('put')
                                @csrf
                                <input  name="game_date" type="hidden" value="{{$game->carbon_date->addDay()}}">
                                <button class="btn btn-primary pull-right">Next Day</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
