<?php

use App\Http\Controllers\DashboardController;
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

Route::get('package', function () {
    return view('package');
});
