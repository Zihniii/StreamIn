@extends('auth.layout')

@section('title', 'login')

@section('content')
<div class="auth-wrapper">
    <div class="illustration-side">
        <div class="illustration-content">
            <img src="{{ asset('img/auth_illust.png') }}" alt="authentication illust">
        </div>
    </div>

    <div class="form-side">
        <div class="auth-card">
            <div class="page-indicator">
                <span class="dot"></span>
                <span class="dot active"></span>
                <span class="dot"></span>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" onsubmit="return handleLogin(event)">
                @csrf

                <div class="form-group">
                    <label class="form-label">
                        Email Address<span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="loginEmail" name="email" value="{{ old('email') }}"
                            placeholder="Input your username" required>
                        <span class="input-icon success" id="loginEmailIcon" style="display: none;">✓</span>
                    </div>
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label">
                            Password<span class="required">*</span>
                        </label>
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="input-wrapper">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="loginPassword" name="password" placeholder="Input your password" required>
                    </div>
                    @error('password')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="error-message" id="loginError" style="display: none;">Invalid Email or Password</div>
                </div>

                <button type="submit" class="btn-primary-custom">Log In</button>
            </form>

            <div class="auth-footer">
                Don't Have an Account? <a class="auth-link" href="{{ route('register') }}">Sign Up</a>
            </div>
        </div>
    </div>
</div>
@endsection