@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 theme-shadow px-4 pt-3">
                <div class="card-header border-0">
                    <h6 class="fs-4 fw-bold"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i> {{ __('Login to your account') }}</h6>
                </div>

                <div class="card-body">
                    <form method="POST" class="row g-3" action="{{ route('login') }}">
                        @csrf

                        <div class="col-12  mb-3">
                            <div class="form-floating">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}" required autocomplete="email" autofocus>
                                <label for="email" >{{ __('Email') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Enter your password') }}" required autocomplete="current-password">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-theme w-100 py-2 fw-bold">
                                    {{ __('Sign In') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link mt-3 text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="text-decoration-none">{{ __('Sign Up') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
