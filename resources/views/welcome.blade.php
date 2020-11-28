@extends('layouts.guest')


@section('content')
    <div class="container">
        <div class="row">
            <div class="span4"></div>
            <div class="span4"><img class="center-block" style="margin-top:200px; margin-bottom:50px" src="img/banner.jpg" /></div>
            <div class="span4"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2 text-center"><a class="btn btn-primary" href="/games/create">New Game</a></div>
            <div class="col-md-2 text-center"><a class="btn btn-primary" href="/games/load">Continue</a></div>
            <div class="col-md-2 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection