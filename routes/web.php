<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportIssueController;
use App\Http\Controllers\SupportPemilihanController;
use App\Http\Controllers\WishlistPackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (GUEST)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
     /*=============================================
    Coded by: Bagas Rafi Dewantara
    NRP: 5026231091
    =============================================  */

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
 /*=============================================
    Coded by: Bagas Rafi Dewantara
    NRP: 5026231091
    =============================================  */
    
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
    Route::get('/home', [PackageController::class, 'showHomepage'])->name('homepage');

    // SEARCH (ambil versi CONTROLLER karena lebih bagus)
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
    | SAVED PACKAGE / WISHLIST
    |--------------------------------------------------------------------------
    */
    Route::prefix('saved-package')->name('saved.')->group(function () {
        Route::get('/', [WishlistPackageController::class, 'index'])->name('index');
        Route::post('/store', [WishlistPackageController::class, 'store'])->name('store');
        Route::delete('/remove', [WishlistPackageController::class, 'destroy'])->name('remove');
        Route::post('/toggle', [WishlistPackageController::class, 'toggle'])->name('toggle');
        Route::get('/check/{packageID}', [WishlistPackageController::class, 'checkStatus'])->name('check');
    });

    /*
    |--------------------------------------------------------------------------
    | CHAT SYSTEM
    |--------------------------------------------------------------------------
    */

    // Versi terbaru dari branch ad24c3...
    Route::get('/chat', [ChatMessageController::class, 'showChatPage'])->name('chat.index');
    Route::post('/chat/send', [ChatMessageController::class, 'sendTextMessage'])->name('chat.send');

    Route::post('/chat/send-photo', [ChatMessageController::class, 'sendPhoto'])->name('chat.send.photo');

    // Show report form for specific subscription
    Route::get('/report/{subscriptionId}', [ReportIssueController::class, 'showReportForm'])
        ->name('report.show');

    // Submit report
    Route::post('/report/submit', [ReportIssueController::class, 'submitReport'])
        ->name('report.submit');

    // View my reports
    Route::get('/my-reports', [ReportIssueController::class, 'myReports'])
        ->name('report.list');

    // View report detail
    Route::get('/report/detail/{id}', [ReportIssueController::class, 'reportDetail'])
        ->name('report.detail');

});

/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/package/{service}', [PackageController::class, 'showPackage'])->name('package.show')->middleware('auth');
//Route::get('/package', fn () => view('package'))->middleware('auth')->name('package');
//Route::get('/payment', fn () => view('payment'))->middleware('auth')->name('payment');
Route::get('/payment', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('payment');

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
Route::post('/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
Route::get('/payment/success', [PaymentController::class, 'showSuccess'])->name('payment.success');
// Route untuk check payment timeout (AJAX)
Route::get('/payment/check-timeout', [PaymentController::class, 'checkTimeout'])->name('payment.check.timeout');
