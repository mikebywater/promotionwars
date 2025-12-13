@extends('layouts.master')

@section('page-title', 'Promotions')

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="title"><strong>Promotions</strong></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promotions as $promotion)
                                        <tr>
                                            <td><a href="/promotions/{{$promotion->id}}">{{$promotion->name}}</a></td>
                                            <td>{{$promotion->size}}</td>
                                            <td>{{$promotion->rating}}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
