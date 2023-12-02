@extends('layouts.guest')

@section('title', trans('Dashboard'))

@section('content')
<div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    @if($error)
        <p class="m-2 alert {{ Session::get('alert-class', 'alert-danger') }}">{{ $error }}</p>
    @endif
    <div class="row">
        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
            <img src="/images/kaptanyuva-logo.png" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Giriş</h1>
                </div>
                <form class="user" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input id="phone_number" type="phone_number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
