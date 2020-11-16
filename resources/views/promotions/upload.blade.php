@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <form action="/promotions/import" method="post" enctype="multipart/form-data">
                            <input name="file" type="file">
                            {{ csrf_field() }}
                            <button class="btn btn-primary pull-right">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
