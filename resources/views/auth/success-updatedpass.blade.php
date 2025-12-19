<!-- Bagas Rafi -->
@extends('auth.layout')

@section('title', 'success-updated-password')

@section('content')
<div class="auth-wrapper page-hidden">
        <div class="illustration-side">
            <div class="illustration-content">
                <img src="{{ asset('img/auth_illust.png') }}" alt="authentication illust">
            </div>
        </div>

        <div class="form-side">
            <div class="auth-card">
                <div class="success-icon">
                     <img src="{{ asset('img/icon_success.png') }}" alt="success-icon">
                </div>

                <div class="welcome-section">
                    <h1 class="welcome-title">Password Successfully<br>Updated!</h1>
                </div>
                <a href="{{ route('login') }}" class="btn-primary-custom" style="text-decoration: none; display: inline-block;">Go to Log In</a>
                <!-- <button class="btn-primary-custom" onclick="window.location.href='{{ route('login') }}'">Go to Log In</button> -->
            </div>
        </div>
    </div>
@endsection

