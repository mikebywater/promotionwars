@extends('layouts.splash')


@section('content')
    <div class="row min-vh-100 bg-gray-dark">
        <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
            <div class="w-100 py-5">
                <div class="text-center"><img src="/img/banner5.png" alt="..." style="max-width: 20rem;" class="img-fluid mb-4">
                    <h1 class="display-4 text-gray-light mb-3">Choose Game</h1>
                </div>

                <hr>

                <form class="form-validate" method="GET" action="/games/create">
                    <h5 class="card-title">New Game</h5>
                    <h6 class="card-subtitle mb-2 text-muted"> - </h6>
                    <a class="btn btn-sm btn-primary" href="/games/create">Create</a>
                </form>
                <hr>
                @if ($games->count())
                    @foreach ($games as $game)

                        <form class="form-validate" method="POST" action="/games">
                            <h5 class="card-title">{{ $game->promoter_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Last Saved : {{ $game->updated_at }}</h6>
                            @csrf
                            <input type="hidden"  name="game_id" value="{{ $game->id }}"/>
                            <button class="btn btn-sm btn-primary">Load</button>
                        </form>
                        <hr>
                    @endforeach
                @endif


            </div>
        </div>

@endsection


{{--<div class="container">--}}

{{--    <div class="row">--}}
{{--        <div class="span4"></div>--}}
{{--        <div class="span4"><img class="center-block" style="margin-top:200px; margin-bottom:50px" src="img/banner.jpg" /></div>--}}
{{--        <h4 class="text-center">Select Game</h4>--}}
{{--        <br>--}}
{{--        <div class="span4"></div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-md-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">New Game</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-muted"> - </h6>--}}
{{--                    <!--            <p class="card-text">sub text.</p> -->--}}
{{--                    <a class="btn btn-sm btn-primary" href="/games/create">Create</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if ($games->count())--}}
{{--            @foreach ($games as $game)--}}

{{--                <div class="col-md-3">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{ $game->promoter_name }}</h5>--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">Last Saved : {{ $game->updated_at }}</h6>--}}
{{--                            <form method="post" action="/games">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden"  name="game_id" value="{{ $game->id }}"/>--}}
{{--                                <button class="btn btn-sm btn-primary">Load</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--        @else--}}
{{--            <p>No Games</p>--}}
{{--            <a href="/">Back</a>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}