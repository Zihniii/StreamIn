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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
        return view('homepage');
    })->name('homepage');

    // 🔍 SEARCH (ambil versi CONTROLLER karena lebih bagus)
    Route::get('/search', [DashboardController::class, 'search'])->name('search');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD - versi terbaru dari branch ad24c3...
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/orders', [DashboardController::class, 'orderHistory'])->name('dashboard.orders');
    Route::get('dashboard/orders/{id}', [DashboardController::class, 'orderHistoryDetail'])->name('dashboard.orders.detail');

    Route::get('dashboard/packages/{id}', [DashboardController::class, 'packageDetail'])->name('dashboard.packages.detail');
    Route::get('dashboard/packages', [DashboardController::class, 'browsePackages'])->name('dashboard.packages.browse');

    Route::post('dashboard/check-expired', [DashboardController::class, 'checkExpiredPackages'])->name('dashboard.checkExpired');
    Route::get('dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    /*
    |--------------------------------------------------------------------------
    | PROFILE (UPLOAD FOTO + SHOW)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [SupportPemilihanController::class, 'profile'])->name('profile');
    Route::post('/profile/upload', [SupportPemilihanController::class, 'uploadImage'])->name('profile.upload');

    /*
    |--------------------------------------------------------------------------
    | CHAT SYSTEM
    |--------------------------------------------------------------------------
    */

    // Versi terbaru dari branch ad24c3...
    Route::get('/chat', [ChatMessageController::class, 'showChatPage'])->name('chat.index');
    Route::post('/chat/send', [ChatMessageController::class, 'sendTextMessage'])->name('chat.send');

    Route::post('/chat/send-photo', [ChatMessageController::class, 'sendPhoto'])->name('chat.send.photo');

});

/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/package', fn () => view('package'))->middleware('auth')->name('package');
Route::get('/payment', fn () => view('payment'))->middleware('auth')->name('payment');

/*
|--------------------------------------------------------------------------
| PACKAGE - ADIFA
|--------------------------------------------------------------------------
*/

Route::get('/package/netflix', [PackageController::class, 'showNetflix'])->name('package.netflix');
Route::get('/package/primevideo', [PackageController::class, 'showPrime'])->name('package.prime');
Route::get('/package/viu', [PackageController::class, 'showViu'])->name('package.viu');

// Route paket streaming lainnya (future)
Route::get('/package/{service}', [PackageController::class, 'showPackage'])->name('package.show');

/*
|--------------------------------------------------------------------------
| PAYMENT DETAILS - ADIFA
|--------------------------------------------------------------------------
*/

Route::get('/payment/details', [PaymentController::class, 'showPaymentDetails'])->name('payment.details');
Route::post('/payment/checkout', [PaymentController::class, 'processCheckout'])->name('payment.checkout');
Route::post('/payment/calculate-discount', [PaymentController::class, 'calculateDiscount'])->name('payment.calculate');
