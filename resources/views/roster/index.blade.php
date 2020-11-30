@extends('layouts.master')

@section('content')

    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-primary">
                        <table class = "table table-striped panel-primary">
                            <tr>
                                <th>Name</th>
                                <th>Draw</th>
                                <th>Ability</th>
                                <th>Promotion</th>
                            </tr>
                            @foreach($wrestlers as $wrestler)
                                <tr>
                                    <td><a href="/wrestlers/{{$wrestler->id}}">{{$wrestler->name}}</a></td>
                                    <td>{{$wrestler->draw}}</td>
                                    <td>{{$wrestler->ability}}</td>
                                    <td><a href="/promotions/{{$wrestler->promotion->id ?? ""}}">{{$wrestler->promotion->name ?? ""}}</a></td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
