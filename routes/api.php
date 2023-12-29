<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConfigurationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ValidateUserAccessToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('configurations', [ConfigurationController::class, 'index'])->name('configurations');
Route::get('packages', [ConfigurationController::class, 'getPackages'])->name('packages');

Route::controller(AuthController::class)->group(function () {
    Route::post('send-otp', 'sendOtp')->name('send_otp');
    Route::post('verify-otp', 'verifyOtp')->name('verify_otp');
});

Route::group(['middleware' => [ValidateUserAccessToken::class]], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('profile', 'getProfile')->name('profile');
        Route::post('profile/set', 'setProfile')->name('profile.set');
        Route::post('update/profile-image', 'updateProfileImage')->name('updateProfileImage');

        Route::get('transactions-history', 'getTransactionHistory')->name('transaction_history');
        Route::get('download-history', 'getDownloadHistory')->name('download_history');
        Route::post('download-history/store', 'storeDownloadHistory')->name('download_history.store');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::post('generate-payment-id', 'generatePaymentId')->name('generate-payment-id');
        Route::post('payment/success', 'success')->name('payment.success');
        Route::post('payment/fail', 'fail')->name('payment.fail');
        Route::post('invoice/download', 'invoiceDownload')->name('invoice.download');
    });
});
