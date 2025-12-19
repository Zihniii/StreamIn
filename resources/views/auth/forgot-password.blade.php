<!-- Bagas Rafi -->
@extends('auth.layout')

@section('title', 'forgot-password')

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
            <form id="forgotForm" method="POST" action="{{ route('password.email') }}" onsubmit="handleForgotPassword(event)">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="forgotEmail" name="email" value="{{ old('email') }}"
                            placeholder="e.g., name@example.com" required>
                        <span class="input-icon success" id="forgotEmailIcon" style="display: none;">✓</span>
                    </div>
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary-custom">Reset Password</button>
            </form>

            <div class="auth-footer">
                Remember your password? <a class="auth-link" href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>

@endsection