<form method="post" action="{{ route('account.updateProfile') }}" class="row g-3 px-3">
    @csrf

    <div class="col-md-6">
        <label for="first_name" class="form-label">{{ __('First Name') }}</label>
        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name ?? '' }}" required autocomplete="first_name" autofocus>
        @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name ?? '' }}" required autocomplete="last_name" autofocus>
        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? '' }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>
        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number ?? '' }}" required autocomplete="phone_number" autofocus>
        @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary px-3">{{ __('Update Profile') }}</button>
    </div>
</form>