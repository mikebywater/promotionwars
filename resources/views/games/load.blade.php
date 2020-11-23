@extends('layouts.guest')

@section('content')
    <div class="container">
        @if ($games->count())
          <form method="post" action="/games">
              @csrf

              <div class="form-group">
                <label for="promotion">Choose your Game</label>
                <select class="form-control" id="promotion" name="game_id">
                  @foreach ($games as $game)
                      <option value="{{ $game->id }}">{{ $game->promoter_name }} - {{ $game->updated_at }}</option>
                  @endforeach
                </select>
              </div>

              <button type="submit" class="btn btn-primary mb-2">Load</button>
          </form>
        @else
          <p>No Games</p>
          <a href="/">Back</a>
        @endif
    </div>
@endsection