@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <p>Name</p>
                            <p>Size</p>
                            <p>Rating</p>
                            <p>Value</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">{{$promotion->name}}</p>
                            <p class="text-right">{{$promotion->size}}</p>
                            <p class="text-right">{{$promotion->rating}}%</p>
                            <p class="text-right">$200,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

