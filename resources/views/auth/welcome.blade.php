<!-- Bagas Rafi -->
@extends('auth.layout')

@section('title', 'welcome')

@section('content')
<div class="auth-wrapper">
    <div class="illustration-side">
        <div class="illustration-content">
            <img src="{{ asset('img/auth_illust.png') }}" alt="authentication illust">
        </div>
    </div>
    <!-- Bagas Rafi -->
    <div class="form-side">
        <div class="auth-card">
            <div class="page-indicator">
                <span class="dot"></span>
                <span class="dot active"></span>
                <span class="dot"></span>
            </div>

            <div class="avatar-container">
                <div class="avatar-bg">
                    <img src="{{ asset('img/welcome_illust.png') }}" alt="avatar illust">

                </div>
            </div>

            <div class="welcome-section">
                <h1 class="welcome-title">Welcome to the<br>Stream.in!</h1>
                <p class="welcome-subtitle">Let's explore your favorite<br>platform</p>
            </div>
            <button class="btn-primary-custom" 
                        data-url="{{ route('register') }}" 
                        onclick="window.location.href=this.dataset.url">Sign Up</button>
            <!-- <button class="btn-primary-custom" onclick="window.location.href='{{ route('register') }}'">Sign Up</button> -->

            <div class="auth-footer">
                Already have an account? <a class="auth-link" href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>
@endsection