@extends('layouts.splash')

@section('content')
        <div class="row min-vh-100 bg-gray-dark">
            <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
                <div class="w-100 py-5">
                    <div class="text-center"><img src="/img/banner5.png" alt="..." style="max-width: 20rem;" class="img-fluid mb-4">
                        <h1 class="display-4 text-gray-light mb-3">Sign in</h1>
                    </div>
                    <form class="form-validate" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" value="{{ old('email') }}" type="email" placeholder="name@address.com" autocomplete="off" required data-msg="Please enter your email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                        <div class="form-group has-danger mb-4">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                                <div class="col-auto">
                                    <a class="form-text small text-muted" href="{{ route('password.request') }}">
                                            Forgotten Your Password?
                                    </a>
                                </div>
                            </div>
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required data-msg="Please enter your password" >
                            @if ($errors->has('password'))
                                <div class="alert-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <!-- Submit-->
                        <button class="btn btn-lg btn-block btn-primary mb-3">Sign in</button>
                        <!-- Link-->
                        <p class="text-center"><small class="text-muted text-center">Don't have an account yet? <a href="/register">Register</a>.</small></p>
                    </form>
                </div>
            </div>

@endsection
