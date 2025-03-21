<?php

use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CustomerMiddleware;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\AppointmentController;

Route::group(['prefix' => 'app', 'middleware' => [CustomAuth::class, CustomerMiddleware::class]], function ($route) {

    Route::get('/', DashboardController::class)->name('customer.dashboard');
    
    // Appointment routes
    Route::get('/booking', [AppointmentController::class, 'index'])->name('customer.booking.index');
    Route::get('/booking/calendar', [AppointmentController::class, 'calendar'])->name('customer.booking.calendar');
    Route::get('/booking/{id}', [AppointmentController::class, 'show'])->name('customer.booking.show');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('customer.orders.show');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('customer.profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('customer.profile.update');

});
