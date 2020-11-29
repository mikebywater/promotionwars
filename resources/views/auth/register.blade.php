@extends('layouts.splash')

@section('content')
    <div class="row min-vh-100 bg-gray-dark">
        <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
            <div class="w-100 py-5">
                <div class="text-center"><img src="/img/banner5.png" alt="..." style="max-width: 20rem;" class="img-fluid mb-4">
                    <h1 class="display-4 text-gray-light mb-3">Sign in</h1>
                </div>
                <form class="form-validate"  method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="John Studd" required data-msg="Please enter your name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('name'))
                            <div class="alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input name="email" value="{{ old('email') }}" type="email" placeholder="john@studd.com" autocomplete="off" required data-msg="Please enter your email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        @if ($errors->has('email'))
                            <div class="alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group has-danger mb-4">
                        <div class="row">
                            <div class="col">
                                <label>Password</label>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required data-msg="Please enter your password" >
                        @if ($errors->has('password'))
                            <div class="alert-danger">{{ $errors->first('password') }}</div>
                        @endif

                    </div>
                    <div class="form-group has-danger mb-4">
                        <div class="row">
                            <div class="col">
                                <label>Confirm Password</label>
                            </div>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>




                    <!-- Submit-->
                    <button class="btn btn-lg btn-block btn-primary mb-3">Sign in</button>
                </form>
            </div>
        </div>



@endsection
