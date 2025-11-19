<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountPackageController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ChatTicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ReportissueController;
use App\Http\Controllers\SubcriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistPackageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SupportPemilihanController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Welcome page (public)
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

// Guest routes
Route::middleware('guest')->group(function () {
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Success page
Route::get('/password-reset-success', [ResetPasswordController::class, 'showSuccessPage'])->name('password.success');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('homepage');
    })->name('homepage');

});

    /*
    |-------------------------
    | PROFILE (Sesuai Diagram)
    |-------------------------
    */

    Route::get('/profile', [SupportPemilihanController::class, 'profile'])->name('profile');

    Route::get('/editProfile', [SupportPemilihanController::class, 'edit'])->name('profile.edit');

    Route::get('/unggahGambar', [SupportPemilihanController::class, 'uploadForm'])->name('profile.upload');

    Route::post('/unggahGambar', [SupportPemilihanController::class, 'uploadImage'])->name('profile.upload.post');

});

/*
|--------------------------------------------------------------------------
| OTHER ROUTES (optional)
|--------------------------------------------------------------------------
*/

// Halaman utama chat
Route::get('/chat', [ChatMessageController::class, 'index'])->name('chat.index');

// Kirim pesan teks
Route::post('/chat/send', [ChatMessageController::class, 'store'])->name('chat.send');

// Halaman upload foto
Route::post('/chat/photo/send', [ChatMessageController::class, 'storePhoto'])->name('chat.send.photo');

// Kirim foto
Route::post('/chat/send-photo', [ChatMessageController::class, 'sendPhoto'])->name('chat.send.photo');
// Halaman utama chat
Route::get('/chat', [ChatMessageController::class, 'index'])->name('chat.index');

// Kirim pesan teks
Route::post('/chat/send', [ChatMessageController::class, 'store'])->name('chat.send');

// Halaman upload foto
Route::post('/chat/photo/send', [ChatMessageController::class, 'storePhoto'])->name('chat.send.photo');

// Kirim foto
Route::post('/chat/send-photo', [ChatMessageController::class, 'sendPhoto'])->name('chat.send.photo');

Route::get('homepage', function () {
    return view('homepage');
});

Route::get('package', function () {
	return view('package');
});

Route::get('payment', function () {
	return view('payment');
});

