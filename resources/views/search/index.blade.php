@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">You search for: {{ $searchTerm }}. {{ count($results) }} result(s) found.</div>
                    <table class="table table-striped panel-primary">
                        <tr>
                            <th>Name</th>
                            <th>Draw</th>
                            <th>Ability</th>
                            <th>Promotion</th>
                        </tr>
                        @foreach($results as $wrestler)
                            <tr>
                                <td><a href="/wrestlers/{{$wrestler->id}}">{{$wrestler->name}}</a></td>
                                <td>{{$wrestler->draw}}</td>
                                <td>{{$wrestler->ability}}</td>
                                <td><a href="/promotions/{{$wrestler->promotion->id}}">{{$wrestler->promotion->name}}</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
