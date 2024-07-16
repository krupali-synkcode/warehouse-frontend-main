@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 theme-shadow px-4 pt-3">
                <div class="card-header border-0">
                    <h6 class="fs-4 fw-bold"><i class="fa-regular fa-user me-2"></i> {{ __('Register for an Account') }}</h6>
                </div>

                <div class="card-body">
                    <form method="POST" class="row g-3" action="{{ route('register') }}">
                        @csrf

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('Enter your first name') }}" required autocomplete="first_name" autofocus>
                                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Enter your last name') }}" required autocomplete="last_name" autofocus>
                                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}" required autocomplete="email">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="{{ __('Enter your phone number') }}" required autocomplete="phone_number" autofocus>
                                <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Enter your password') }}" required autocomplete="new-password">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Enter your password') }}" required autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>

                        <div class="col-12 mb-0 mt-4 text-center">
                            <button type="submit" class="btn btn-theme px-4 w-100 py-2 fw-bold">
                                {{ __('Sign Up') }}
                            </button>
                            <p class="mt-3">{{ __("Already have an account?") }} <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Sign In') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
