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

                    <h4 class="card-title mb-1">Welcome to {{ config('app.name') }}! 👋</h4>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                    @include('layouts.partials.flash_messages')
                    <form class="auth-login-form mt-2" action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus/>
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                                <a href="{{ route('forgot_password') }}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                    </form>
                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
@endsection
@push('footer_scripts')
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/scripts/pages/page-auth-login.js') }}"></script>
    <!-- END: Page JS-->
@endpush
