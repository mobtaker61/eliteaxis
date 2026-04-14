<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminLiveServiceController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\ServiceBookingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/en');

Route::get('/{locale}', HomeController::class)->whereIn('locale', ['en', 'ar'])
    ->middleware('setLocale')
    ->name('home');

Route::post('/{locale}/book-service', ServiceBookingController::class)->whereIn('locale', ['en', 'ar'])
    ->middleware('setLocale')
    ->name('book-service.store');
Route::get('/{locale}/book-service/customer-lookup', [ServiceBookingController::class, 'lookupCustomer'])->whereIn('locale', ['en', 'ar'])
    ->middleware('setLocale')
    ->name('book-service.lookup');

Route::prefix('/{locale}/admin')->whereIn('locale', ['en', 'ar'])
    ->middleware('setLocale')
    ->name('admin.')
    ->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
        Route::post('/login/captcha-refresh', [AdminAuthController::class, 'refreshCaptcha'])->name('login.captcha.refresh');

        Route::middleware('admin.auth')->group(function () {
            Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
            Route::get('/', AdminDashboardController::class)->name('dashboard');
            Route::get('/live-service', AdminLiveServiceController::class)->name('live-service');

            Route::resource('services', AdminServiceController::class)->except(['show']);

            Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
            Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');
            Route::get('/customers/{customer}/edit', [AdminCustomerController::class, 'edit'])->name('customers.edit');
            Route::put('/customers/{customer}', [AdminCustomerController::class, 'update'])->name('customers.update');

            Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
            Route::get('/bookings/{serviceBooking}/edit', [AdminBookingController::class, 'edit'])->name('bookings.edit');
            Route::put('/bookings/{serviceBooking}', [AdminBookingController::class, 'update'])->name('bookings.update');
            Route::put('/bookings/{serviceBooking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
        });
    });
