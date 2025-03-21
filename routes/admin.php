<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\UserController as ClientController;



Route::group(['prefix' => 'administration', 'middleware' => [CustomAuth::class,  AdminMiddleware::class]], function() {
    Route::get('/', DashboardController::class)->name('admin.dashboard');
    // Clients routes
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('admin.clients.show');
    // Services routes
    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('admin.services.show');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    // Service categories routes
    Route::get('/service-categories', [ServiceCategoryController::class, 'index'])->name('admin.serviceCategories.index');
    Route::post('/service-categories', [ServiceCategoryController::class, 'store'])->name('admin.serviceCategories.store');
    Route::get('/service-categories/create', [ServiceCategoryController::class, 'create'])->name('admin.serviceCategories.create');
    Route::get('/service-categories/{id}', [ServiceCategoryController::class, 'show'])->name('admin.serviceCategories.show');
    Route::get('/service-categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('admin.serviceCategories.edit');
    Route::put('/service-categories/{id}', [ServiceCategoryController::class, 'update'])->name('admin.serviceCategories.update');
    Route::delete('/service-categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('admin.serviceCategories.destroy');

    // Orders routes

    // Booking Calendar
    Route::get('/booking/calendar', [AppointmentController::class, 'calendar'])->name('admin.booking.calendar');
    Route::get('/booking/list', [AppointmentController::class, 'index'])->name('admin.booking.index');
    Route::get('/booking/{id}', [AppointmentController::class, 'show'])->name('admin.booking.show');
    Route::patch('/booking/{id}', [AppointmentController::class, 'changeStatus'])->name('admin.booking.changeStatus');

    // Products routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Categories routes
    Route::get('/categories', [ProductCategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [ProductCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/create', [ProductCategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('/categories/{id}', [ProductCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/categories/{id}/edit', [ProductCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [ProductCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Orders routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}', [OrderController::class, 'changeStatus'])->name('admin.orders.changeStatus');

    // Payments routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');

    Route::get('/profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('/profile/', [ProfileController::class, 'update'])->name('admin.profile.update');
});


