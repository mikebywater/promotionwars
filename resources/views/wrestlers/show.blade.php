@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                    <div class="panel-body">
                        <p>{{$wrestler->name}}</p>
                        <p>{{$wrestler->draw}}</p>
                        <p>{{$wrestler->ability}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Contract</div>
                    <div class="panel-body">
                        <p>{{$wrestler->promotion_id}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
