@extends('layouts.guest')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <form action="/games" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="promotions-file">Promoters File</label>
                                <input id="promotions-file" name="promotions-file" type="file">
                            </div>
                            <div class="form-group">
                                <label for="wrestlers-file">Wrestlers File</label>
                                <input name="wrestlers-file" type="file">
                            </div>
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
                </div>
            </div>
        </div>
    </div>







    </div>
@endsection