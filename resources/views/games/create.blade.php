@extends('layouts.splash')


@section('content')
    <div class="row min-vh-100 bg-gray-dark">
        <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
            <div class="w-100 py-5">
                <div class="text-center"><img src="/img/banner5.png" alt="..." style="max-width: 20rem;" class="img-fluid mb-4">
                    <h1 class="display-4 text-gray-light mb-3">Create Game</h1>
                </div>

                <hr>

                <form action="/games" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="promotions-file">Promoters File</label>
                        <input id="promotions-file" name="promotions-file" type="file">
                    </div>
                    <div class="form-group">
                        <label for="wrestlers-file">Wrestlers File</label>
                        <input name="wrestlers-file" type="file">
                    </div>
                    @csrf


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="promoter_name" placeholder="Enter your name">
                    </div>


                    <button type="submit" class="btn btn-primary mb-2">Create</button>
                </form>

                <hr>



            </div>
        </div>

        @endsection
