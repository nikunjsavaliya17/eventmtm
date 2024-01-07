@extends('layouts.auth_master')
@section('content')
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo" height="28">
                        <h2 class="brand-text text-primary ms-1">{{ config('app.name') }}</h2>
                    </a>

                    <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
                    <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
                    @include('layouts.partials.flash_messages')
                    <form class="auth-login-form mt-2" action="{{ route('reset_link.send') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="email"
                                   placeholder="john@example.com" aria-describedby="login-email" tabindex="1"/>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="2">Send reset link</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Back to login </a>
                    </p>
                </div>
            </div>
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
                        'email': {
                            required: true,
                            email: true
                        },
                    }
                });
            }
        });
    </script>
@endpush

