@extends('layouts.splash')


@section('content')
    <div class="row min-vh-100 bg-gray-dark">
        <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
            <div class="w-100 py-5">
                <div class="text-center"><img src="/img/banner5.png" alt="..." style="max-width: 20rem;" class="img-fluid mb-4">
                    <h1 class="display-4 text-gray-light mb-3">Create Game</h1>
                </div>

                <hr>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/games" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="data-pack-zip">Data Pack (ZIP File) - New Format</label>
                        <input id="data-pack-zip" name="data-pack-zip" type="file" accept=".zip" class="form-control-file">
                        <small class="form-text text-muted">Upload a zip file containing .fed files and wrestlers.pw1</small>
                        @error('data-pack-zip')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <hr>
                        <p class="text-muted text-center">OR use old format:</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="promotions-file">Promoters File (Old Format)</label>
                        <input id="promotions-file" name="promotions-file" type="file">
                    </div>
                    <div class="form-group">
                        <label for="wrestlers-file">Wrestlers File (Old Format)</label>
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
