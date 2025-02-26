<?php

use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactPost'])->name('contact.post');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{id}', [HomeController::class, 'serviceShow'])->name('service.show');
Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
//Route::get('/booking', [HomeController::class, 'booking'])->middleware(CustomAuth::class)->name('booking');
Route::post('/booking', [HomeController::class, 'bookingPost'])->name('booking.post');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');


Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart', [CartController::class, 'cartPost'])->name('cart.post');
Route::delete('/cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::delete('/cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');

Route::middleware(CustomAuth::class)->group(function() {
    // Route::middleware(CustomAuth::class)->post('/cart/merge', [CartController::class, 'mergeCart'])->name('cart.merge');

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/appointment', [HomeController::class, 'checkoutAppointmentPost'])->name('checkout.appointment.post');
    Route::post('/checkout/order', [HomeController::class, 'checkoutOrderPost'])->name('checkout.order.post');
    Route::get('/paypal/success', [HomeController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [HomeController::class, 'paypalCancel'])->name('paypal.cancel');
    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('/wishlist', [HomeController::class, 'wishlistPost'])->name('wishlist.post');
    Route::post('/review', [HomeController::class, 'reviewPost'])->name('review.post');

});


Route::group(['prefix' => 'auth'], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(CustomAuth::class)->name('logout');

    Route::middleware('guest')->group(function() {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
        Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('forgot-password.post');
        Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
        Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset-password.post');
    });
});

require __DIR__ . '/admin.php';

require __DIR__ . '/client.php';

