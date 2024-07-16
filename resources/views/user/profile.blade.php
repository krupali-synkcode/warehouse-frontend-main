@extends('layouts.app')

@section('title', __('My Account'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('components.user-sidebar')
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0">My Account</h1>
            </div>
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">{{ __('Profile') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="true">{{ __('Change Password') }}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Sho profile form -->
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    @include('user.partials.form-profile')
                </div>

                <!-- Show password change form -->
                <div class="tab-pane fade  " id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                    @include('user.partials.form-update-password')
                </div>
            </div>
        </div>
    </div>
@endsection