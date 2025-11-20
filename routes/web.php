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
use App\Http\Controllers\Auth\ResetPasswordController;


use App\Http\Controllers\SupportPemilihanController;




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (GUEST)
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');




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


Route::get('/password-reset-success', [ResetPasswordController::class, 'showSuccessPage'])
    ->name('password.success');




/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/


Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');




/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {


    // Homepage
    Route::get('/home', function () {
        return view('homepage'); // sesuai file kamu
    })->name('homepage');


    // Search
    Route::get('/search', function () {
        return view('search');
    })->name('search');


    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');


    // Active Package
    Route::get('/active-package', function () {
        return view('dashboard.activepackage');
    })->name('active.package');




    /*
    |--------------------------------------------------------------------------
    | PROFILE (UPLOAD FOTO + SHOW)
    |--------------------------------------------------------------------------
    */


    Route::get('/profile', [SupportPemilihanController::class, 'profile'])
        ->name('profile');


    Route::post('/profile/upload', [SupportPemilihanController::class, 'uploadImage'])
        ->name('profile.upload');




    /*
    |--------------------------------------------------------------------------
    | CHAT SYSTEM
    |--------------------------------------------------------------------------
    */


    Route::get('/chat', [ChatMessageController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatMessageController::class, 'store'])->name('chat.send');
    Route::post('/chat/send-photo', [ChatMessageController::class, 'sendPhoto'])->name('chat.send.photo');
});




/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/


Route::get('/package', fn () => view('package'))->middleware('auth')->name('package');
Route::get('/payment', fn () => view('payment'))->middleware('auth')->name('payment');
