@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <table class="table table-striped panel-primary">
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Rating</th>
                        </tr>
                        @foreach($promotions as $promotion)
                            <tr>
                                <td><a href="/promotions/{{$promotion->id}}">{{$promotion->name}}</a></td>
                                <td>{{$promotion->size}}</td>
                                <td>{{$promotion->rating}}%</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
