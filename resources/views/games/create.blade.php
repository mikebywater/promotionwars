@extends('layouts.guest')

@section('content')
    <div class="container">
        <form method="post" action="/games">
            @csrf

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="promoter_name" placeholder="Enter your name">
            </div>

            <div class="form-group">
              <label for="promotion">Choose your Promotion</label>
              <select class="form-control" id="promotion" name="promotion_id">
                @foreach ($promotions as $promotion)
                    <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                @endforeach
              </select>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Create</button>
        </form>
    </div>
@endsection