<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EventCompanyManagementController;
use App\Http\Controllers\EventManagementController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FoodEventController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\FoodPartnerController;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SponsorTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authenticate', 'authenticate')->name('authenticate');

    Route::get('forgot-password', 'forgotPassword')->name('forgot_password');
    Route::post('reset-link/send', 'sendResetPasswordLink')->name('reset_link.send');
    Route::get('reset-password/{token}', 'resetPassword')->name('reset_password_link');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout')->name('logout');
    });

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//
//    Route::controller(AdminController::class)->group(function () {
//        Route::get('profile', 'profile')->name('profile');
//        Route::post('profile/update', 'updateProfile')->name('profile.update');
//    });
//
//    Route::resource('admins', AdminController::class);

    Route::group(['middleware' => ['canUser:email-templates-read'], 'prefix' => '/email-templates', 'as' => 'email_templates.'], function () {
        Route::controller(EmailTemplateController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
        });
    });

    Route::group(['middleware' => ['canUser:custom-page-read'], 'prefix' => '/custom-page', 'as' => 'custom_page.'], function () {
        Route::controller(PageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
        });
    });

    Route::group(['middleware' => ['canUser:roles-read'], 'prefix' => '/roles', 'as' => 'roles.'], function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
        });
    });

    Route::group(['middleware' => ['canUser:event-company-read'], 'prefix' => '/event-company-management', 'as' => 'event_company_management.'], function () {
        Route::controller(EventCompanyManagementController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:event-read'], 'prefix' => '/event-management', 'as' => 'event_management.'], function () {
        Route::controller(EventManagementController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:sponsor-type-read'], 'prefix' => '/sponsor-types', 'as' => 'sponsor_types.'], function () {
        Route::controller(SponsorTypeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:sponsor-read'], 'prefix' => '/sponsors', 'as' => 'sponsors.'], function () {
        Route::controller(SponsorController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:food-partner-read'], 'prefix' => '/food-partners', 'as' => 'food_partners.'], function () {
        Route::controller(FoodPartnerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:food-event-read'], 'prefix' => '/food-events', 'as' => 'food_events.'], function () {
        Route::controller(FoodEventController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:food-type-read'], 'prefix' => '/food-types', 'as' => 'food_types.'], function () {
        Route::controller(FoodTypeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:food-menu-read'], 'prefix' => '/food-menu', 'as' => 'food_menu.'], function () {
        Route::controller(FoodMenuController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:order-read'], 'prefix' => '/orders', 'as' => 'orders.'], function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/detail', 'detail')->name('detail');
        });
    });

    Route::group(['middleware' => ['canUser:admin-user-read'], 'prefix' => '/admin-users', 'as' => 'admin_users.'], function () {
        Route::controller(AdminUserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:faqs-read'], 'prefix' => '/faqs', 'as' => 'faqs.'], function () {
        Route::controller(FaqController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store-update', 'store_update')->name('store_update');
            Route::post('/update-data', 'update_data')->name('update_data');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::group(['middleware' => ['canUser:configuration-read'], 'prefix' => '/configuration', 'as' => 'configuration.'], function () {
        Route::controller(ConfigurationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
        });
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('orders', 'orders')->name('orders')->middleware(['canUser:orders-read']);
        Route::get('users', 'appUsers')->name('app_users')->middleware(['canUser:app-users-read']);
        Route::post('users/update-status', 'updateAppUserStatus')->name('app_users.update_status')->middleware(['canUser:app-users-write']);
    });
});
