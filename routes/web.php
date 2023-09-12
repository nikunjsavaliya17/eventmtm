<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\EventCompanyManagementController;
use App\Http\Controllers\EventManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

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

require __DIR__ . '/auth.php';

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/', fn() => view('index'))->name('home');

    Route::group(['prefix' => '/event-company-management', 'as' => 'event_company_management.'], function () {
        Route::controller(EventCompanyManagementController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
        });
    });

    Route::group(['prefix' => '/event-management', 'as' => 'event_management.'], function () {
        Route::controller(EventManagementController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
        });
    });

    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
