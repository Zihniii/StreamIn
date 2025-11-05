@extends('auth.layout')

@section('title', 'egister')

@section('content')
<div class="auth-wrapper">
    <div class="illustration-side">
        <div class="illustration-content">
            <img src="{{ asset('img/auth_illust.png') }}" alt="authentication illust">
        </div>
    </div>

    <div class="form-side">
        <div class="auth-card">
            <form id="signupForm" method="POST" action="{{ route('register') }}" onsubmit="return handleSignup(event)">
                @csrf
                
                
                <div class="form-group">
                    <label class="form-label">Email Address<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="signupEmail" name="email" value="{{ old('email') }}" 
                               placeholder="e.g., name@example.com" required>
                        <span class="input-icon success" id="signupEmailIcon" style="display: none;">✓</span>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Name<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="signupName" name="name" value="{{ old('name') }}" 
                               placeholder="Enter your name" required>
                        <span class="input-icon success" id="signupNameIcon" style="display: none;">✓</span>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="signupPassword" name="password" placeholder="Enter your password" required>
                        <span class="input-icon" onclick="togglePassword('signupPassword', this)">
                            <img src="{{ asset('img/eye-close.png') }}" alt="toggle password">
                        </span>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @else
                        <div class="error-message" id="signupPasswordError" style="display: none;">
                            Must be 8 or more characters and contain at least 1 number and 1 special character
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password<span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="signupConfirmPassword" 
                               name="password_confirmation" placeholder="Repeat your password" required>
                        <span class="input-icon" onclick="togglePassword('signupConfirmPassword', this)">
                            <img src="{{ asset('img/eye-close.png') }}" alt="toggle password">
                        </span>
                    </div>
                    <div class="error-message" id="signupConfirmError" style="display: none;">
                        The Password Confirmation does not match
                    </div>
                </div>

                <button type="submit" class="btn-primary-custom">Register</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a class="auth-link" href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>
@endsection