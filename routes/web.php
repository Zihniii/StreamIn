<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.welcome');
});
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('reset-password', function () {
    return view('auth.reset-password');
})->name('reset-password');

Route::get('success-updatedpass', function () {
    return view('auth.success-updatedpass');
})->name('success-updatedpass');

Route::get('chat', function () {
    return view('chatcs.chat');
});

Route::get('chatphoto', function () {
    return view('chatcs.chatphoto');
});

Route::get('homepage', function () {
    return view('homepage');
});

// Dashboard Preview dengan Dummy Data
Route::get('dashboard', function () {
    // Dummy user data
    $dummyUser = (object)[
        'name' => 'John Doe',
        'avatar' => null,
        'points' => 250,
        'badge' => 'The Watcher'
    ];

    // Dummy active packages
    $activePackages = collect([
        (object)[
            'id' => 1,
            'platform_name' => 'Netflix',
            'duration' => 3,
            'expires_at' => '2025-04-31 15:20:00',
            'status' => 'active'
        ],
        (object)[
            'id' => 2,
            'platform_name' => 'Prime Video',
            'duration' => 3,
            'expires_at' => '2025-04-24 15:20:00',
            'status' => 'active'
        ],
        (object)[
            'id' => 3,
            'platform_name' => 'Viu',
            'duration' => 3,
            'expires_at' => '2025-04-22 13:20:00',
            'status' => 'active'
        ],
    ]);

    return view('dashboard', compact('activePackages', 'dummyUser'));
})->name('dashboard');
