<?php

use App\Http\Controllers\API\AppUserController;
use App\Http\Controllers\API\AuthController;
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
});

Route::group(['middleware' => [ValidateUserAccessToken::class]], function () {
    Route::controller(AppUserController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('profile/update', 'updateProfile');
    });
});
