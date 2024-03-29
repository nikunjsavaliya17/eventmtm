<?php

use App\Http\Controllers\API\AppUserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConfigurationController;
use App\Http\Controllers\API\HomeController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forgot-password', 'forgotPassword');
    Route::post('reset-password', 'resetPassword');
    Route::post('verify-otp', 'verifyOtp');
});

Route::controller(ConfigurationController::class)->group(function () {
    Route::get('configurations', 'configurations');
    Route::get('faqs', 'faqs');
    Route::get('page-detail', 'pageDetail');
});

Route::group(['middleware' => [ValidateUserAccessToken::class]], function () {
    Route::controller(AppUserController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('profile/update', 'updateProfile');
        Route::post('password/update', 'updatePassword');

        Route::get('orders', 'orderList');
        Route::get('order-detail', 'orderDetails');
        Route::post('cancel-order', 'cancelOrder');

        Route::get('cart-list', 'cartList');
        Route::post('add-cart', 'addCart');
        Route::post('remove-cart', 'removeCart');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('home', 'home');
        Route::get('event-detail', 'eventDetail');
        Route::get('restaurants', 'restaurants');
        Route::get('menu-list', 'menuList');
    });
});
