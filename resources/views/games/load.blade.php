@extends('layouts.guest')

@section('content')
    <div class="container">
        @if ($games->count())
            @foreach ($games as $game)

          <form method="post" action="/games">
              @csrf
              <input type="hidden"  name="game_id" value="{{ $game->id }}"/>
              <button type="submit" class="btn btn-primary mb-2">{{ $game->promoter_name }} - {{ $game->updated_at }}</button>
          </form>
            @endforeach
        @else
          <p>No Games</p>
          <a href="/">Back</a>
        @endif
    </div>
@endsection