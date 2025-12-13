@extends('layouts.master')

@section('page-title', $promotion->name)

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="block">
                        <div class="title"><strong>Promotion Profile</strong></div>
                        <div class="block-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong></p>
                                    <p><strong>Size:</strong></p>
                                    <p><strong>Rating:</strong></p>
                                    <p><strong>Funds:</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$promotion->name}}</p>
                                    <p>{{$promotion->size}}</p>
                                    <p>{{$promotion->popularity}}%</p>
                                    <p>${{number_format($promotion->funds)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
