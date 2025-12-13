@extends('layouts.master')

@section('page-title', 'Search Results')

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="title"><strong>Search Results</strong></div>
                        <p>You searched for: <strong>{{ $searchTerm }}</strong>. {{ count($results) }} result(s) found.</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Draw</th>
                                        <th>Ability</th>
                                        <th>Promotion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $wrestler)
                                        <tr>
                                            <td><a href="/wrestlers/{{$wrestler->id}}">{{$wrestler->name}}</a></td>
                                            <td>{{$wrestler->draw}}</td>
                                            <td>{{$wrestler->ability}}</td>
                                            <td><a href="/promotions/{{$wrestler->promotion->id ?? ""}}">{{$wrestler->promotion->name ?? ""}}</a></td>
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
