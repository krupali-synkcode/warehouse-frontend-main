@extends('layouts.app')

@section('title', __('Reset Password'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 theme-shadow px-4 py-3">
                <div class="card-header border-0">
                    <h6 class="fs-4 fw-bold"><i class="fa-solid fa-repeat me-2"></i> {{ __('Reset Password') }}</h6>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" class="row g-3" action="{{ route('password.email') }}">
                        @csrf

                        <div class="col-12">
                            <div class="form-floating">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}"  required autocomplete="email" autofocus>
                                <label for="email">{{ __('Email Address') }}</label>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-0">
                            <button type="submit" class="btn btn-theme px-4  w-100 py-2">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
