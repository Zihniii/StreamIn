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

                <form id="forgotForm" onsubmit="handleForgotPassword(event)">
                    <div class="form-group">
                        <label class="form-label">Email Address<span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input type="email" class="form-control" id="forgotEmail" placeholder="e.g., name@example.com">
                            <span class="input-icon success" id="forgotEmailIcon" style="display: none;">✓</span>
                        </div>
                        <!-- <div class="input-wrapper">
                            <input type="email" class="form-control is-valid" id="forgotEmail" value="keenan@gmail.com">
                        </div> -->
                        <div class="error-message" id="forgotEmailError" style="display: none;">Invalid Email</div>
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