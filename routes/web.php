<?php

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

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Welcome page (public)
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

// Guest routes (only for non-authenticated users)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Success page (accessible without auth)
Route::get('/password-reset-success', [ResetPasswordController::class, 'showSuccessPage'])->name('password.success');

// Logout (for authenticated users)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
	// Dashboard or Home Page
    Route::get('/home', function () {
        return view('homepage');
    })->name('homepage'); 
    
});

// Route::get('/', function () {
// 	return view('auth.welcome');
// });
// Route::get('login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('register', function () {
//     return view('auth.register');
// })->name('register');

// Route::get('forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');

// Route::get('reset-password', function () {
//     return view('auth.reset-password');
// })->name('reset-password');

// Route::get('success-updatedpass', function () {
//     return view('auth.success-updatedpass');
// })->name('success-updatedpass');


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





