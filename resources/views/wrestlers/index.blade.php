@extends('layouts.app')

@section('content')
    <h3>Wrestlers</h3>
    <table class = "table table-striped">
        <tr>
            <th>Name</th>
            <th>Draw</th>
            <th>Ability</th>
        </tr>
        @foreach($wrestlers as $wrestler)
            <tr>
                <td>{{$wrestler->name}}</td>
                <td>{{$wrestler->draw}}</td>
                <td>{{$wrestler->ability}}</td>
            </tr>
        @endforeach

    </table>


@endsection
