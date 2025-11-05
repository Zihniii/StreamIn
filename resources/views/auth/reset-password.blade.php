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

                <form id="resetForm" onsubmit="handleResetPassword(event)">
                    <div class="form-group">
                        <label class="form-label">Password<span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="resetPassword" placeholder="············">
                            <span class="input-icon" onclick="togglePassword('resetPassword', this)">
                                <img src="{{ asset('img/eye-close.png') }}" alt="toggle password">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password<span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="resetConfirmPassword" placeholder="············">
                            <span class="input-icon" onclick="togglePassword('resetConfirmPassword', this)">
                                <img src="{{ asset('img/eye-close.png') }}" alt="toggle password">
                            </span>
                        </div>
                        <div class="error-message" id="resetError" style="display: none;">Invalid Email</div>
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