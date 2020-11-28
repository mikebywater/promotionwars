@extends('layouts.guest')


@section('content')
    <div class="container">

        <div class="row">
            <div class="span4"></div>
            <div class="span4"><img class="center-block" style="margin-top:200px; margin-bottom:50px" src="img/banner.jpg" /></div>
            <h4 class="text-center">Select Game</h4>
            <br>
            <div class="span4"></div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Game</h5>
                        <h6 class="card-subtitle mb-2 text-muted"> - </h6>
            <!--            <p class="card-text">sub text.</p> -->
                        <a class="btn btn-sm btn-primary" href="/games/create">Create</a>
                    </div>
                </div>
            </div>

            @if ($games->count())
                @foreach ($games as $game)

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $game->promoter_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Last Saved : {{ $game->updated_at }}</h6>
                                <form method="post" action="/games">
                                    @csrf
                                    <input type="hidden"  name="game_id" value="{{ $game->id }}"/>
                                    <button class="btn btn-sm btn-primary">Load</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <p>No Games</p>
                <a href="/">Back</a>
            @endif
        </div>
    </div>
@endsection