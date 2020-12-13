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
                                <th>Charisma</th>
                                <th>Mic Skills</th>
                                <th>Role</th>
                            </tr>
                            @foreach($wrestlers as $wrestler)
                                <tr>
                                    <td><a href="/wrestlers/{{$wrestler->id}}">{{$wrestler->name}}</a></td>
                                    <td class="{{($wrestler->draw < 65) ? 'text-danger' : ''}}  {{($wrestler->draw > 79) ? 'text-success' : 'text-warning'}}">{{$wrestler->draw}}</td>
                                    <td class="{{($wrestler->ability < 65) ? 'text-danger' : ''}}  {{($wrestler->ability > 79) ? 'text-success' : 'text-warning'}}">{{$wrestler->ability}}</td>
                                    <td class="{{($wrestler->charisma < 65) ? 'text-danger' : ''}}  {{($wrestler->charisma > 79) ? 'text-success' : 'text-warning'}}">{{$wrestler->charisma}}</td>
                                    <td class="{{($wrestler->mic_skills < 65) ? 'text-danger' : ''}}  {{($wrestler->mic_skills > 79) ? 'text-success' : 'text-warning'}}">{{$wrestler->mic_skills}}</td>
                                    <td>{{$wrestler->role}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
