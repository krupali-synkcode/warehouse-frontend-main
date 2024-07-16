@extends('layouts.app')

@section('title', __('Reset Password'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 theme-shadow px-4 pt-3">
                <div class="card-header border-0">
                    <h6 class="fs-4 fw-bold"><i class="fa-solid fa-repeat me-2"></i> {{ __('Reset Password') }}</h6>
                </div>

                <div class="card-body">
                    <form method="POST" class="row g-3" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Enter your email') }}"  required autocomplete="email" autofocus>
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Enter your new password') }}"  required autocomplete="new-password">
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Enter your cnofirm password') }}"  required autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>

                        <div class="col-12 mb-0">
                            <button type="submit" class="btn btn-theme px-4 w-100 py-2">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
