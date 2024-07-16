@extends('layouts.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 theme-shadow px-4 py-3">
                <div class="card-header border-0">
                    <h6 class="fs-4 fw-bold"><i class="fa-solid fa-repeat me-2"></i> {{ __('Confirm Password') }}</h6>
                </div>

                <div class="card-body">
                    <form method="POST" class="row g-3" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Enter your password') }}" required autocomplete="current-password">
                                <label for="password">{{ __('Password') }}</label>
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-0">
                            <div class="d-flex justify-content-between text-center">
                                <button type="submit" class="btn btn-theme px-4 w-100 py-2">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
