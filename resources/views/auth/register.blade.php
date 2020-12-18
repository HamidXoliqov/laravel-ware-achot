@extends('layouts.login')
@section('title')
    {{'Sign in'}}
@stop
@section('content')
<div class="wrap-login100">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{asset('themes/backend/login/images/img-01.png')}}" alt="IMG">
    </div>
    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <span class="login100-form-title">
            {{ __('Register') }}
        </span>
        <div class="wrap-input100 validate-input">
            <input id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <p class="erros-text">{{ $message }}</p>
            </span>
        @enderror
        <div class="wrap-input100 validate-input">
            <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
            <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                {{ __('Register') }}
            </button>
        </div>
        <div class="text-center p-t-12">
        <span class="txt1">
            Forgot
        </span>
        <a class="txt2" href="#">
            Login
        </a>
        </div>
    </form>
</div>

@endsection
