@extends('auth.layout')

@section('title', 'reset-password')

@section('content')
<div class="auth-wrapper page-hidden">
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

            <div class="welcome-section">
                <h1 class="welcome-title">Forgot Password</h1>
            </div>

            <form id="resetForm" method="POST" action="{{ route('password.update') }}" onsubmit="handleResetPassword(event)">
                @csrf

                <div class="form-group">
                    <label class="form-label">Password<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="resetPassword" name="password" placeholder="············" required>
                    </div>
                    @error('password')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="resetConfirmPassword"
                            name="password_confirmation" placeholder="············" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary-custom">Confirm Reset Password</button>
            </form>

            <div class="auth-footer">
                Remember your password? <a class="auth-link" href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>
@endsection