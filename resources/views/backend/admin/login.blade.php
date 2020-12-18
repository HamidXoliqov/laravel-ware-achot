@extends('layouts.login')
@section('title')
    {{'Login'}}
@stop
@section('content')
<div class="wrap-login100">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{asset('themes/backend/login/images/img-01.png')}}" alt="IMG">
    </div>
    <form class="login100-form validate-form"  action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
        <span class="login100-form-title">
            Member Login
        </span>
        <!-- <p style="color: red;text-align: center;margin-bottom: 10px;margin-top: -20px">
            {{($xabar)??''}}
        </p> -->
        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <p class="erros-text">{{ $message }}</p>
            </span>
        @enderror
        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <p class="erros-text">{{ $message }}</p>
            </span>
        @enderror
        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember" id="remember" />
                    <label class="custom-control-label" for="rememberPasswordCheck">
                        Remember password
                    </label>
                </div>
            </div>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Login
            </button>
        </div>
        <div class="text-center p-t-12">
            <span class="txt1">
                Sing up
            </span>
            @if (Route::has('password.request'))
                <a class="txt2" href="{{ route('signup') }}">
                    {{ __('Not registered ?') }}
                </a>
            @endif
        </div>
    </form>
</div>
@endsection
