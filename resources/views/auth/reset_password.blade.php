@extends('layouts.auth_master')
@section('content')
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img src="{{ url('assets/images/favicon.png') }}" alt="Logo" height="28">
                        <h2 class="brand-text text-primary ms-1">{{ config('app.name') }}</h2>
                    </a>

                    <h4 class="card-title mb-1">Reset Password 🔒</h4>
                    <p class="card-text mb-2">Your new password must be different from previously used passwords</p>
                    @include('layouts.partials.flash_messages')
                    <form class="auth-login-form mt-2" action="{{ route('admin_password.store') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="email"
                                   placeholder="john@example.com" aria-describedby="login-email" tabindex="1"
                                   value="{{ $recordExist->email }}" readonly/>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge"
                                       id="password" name="password" tabindex="2"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="login-password"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge"
                                       id="confirm-password" name="confirm-password" tabindex="2"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="confirm-password-password"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="3">Set New Password</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Back to login </a>
                    </p>
                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script>
        $(function () {
            'use strict';

            var pageLoginForm = $('.auth-login-form');

            if (pageLoginForm.length) {
                pageLoginForm.validate({
                    rules: {
                        'password': {
                            required: true,
                        },
                        'confirm-password': {
                            required: true,
                            equalTo: '#password'
                        },
                    }
                });
            }
        });
    </script>
@endpush
