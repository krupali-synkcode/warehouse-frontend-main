<form method="post" action="{{ route('account.updatePassword') }}" class="row g-3 px-3">
    @csrf

    <div class="col-md-6">
        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
        @error('current_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary px-3">{{ __('Update Password') }}</button>
    </div>

    <div class="col-12">
        <div class="mt-4">
            <h5 class="mb-2">{{ __('Password must contain:') }} </h5>
            <ul>
                <li>{{ __('At least 1 uppercase letter (A-Z)') }}</li>
                <li>{{ __('At least 1 number (0-9)') }}</li>
                <li>{{ __('At least 8 characters') }}</li>
            </ul>
        </div>
    </div>
</form>