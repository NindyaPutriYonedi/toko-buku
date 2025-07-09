<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NindyAuthController;
use App\Http\Controllers\NindyBookController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NindyHistoryController;

Route::get('/', [NindyBookController::class, 'index'])->name('books.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [NindyAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [NindyAuthController::class, 'login']);
    Route::get('/register', [NindyAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [NindyAuthController::class, 'register']);
});

Route::post('/logout', [NindyAuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [NindyBookController::class, 'cart'])->name('cart.index');
    Route::post('/checkout', [NindyBookController::class, 'checkout'])->name('checkout');
    Route::post('/cart/add/{id}', [NindyBookController::class, 'addToCart'])->name('cart.add');
    Route::post('/book/{id}/buy', [NindyBookController::class, 'buyNow'])->name('book.buy');

    Route::post('/cart/update/{id}', [NindyBookController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove/{id}', [NindyBookController::class, 'removeCart'])->name('cart.remove');
    Route::get('/orders/history', [NindyHistoryController::class, 'index'])->name('books.history');
    Route::get('/buy-now/{id}', [NindyBookController::class, 'showBuyNow'])->name('buyNow.show');
    Route::post('/buy-now/{id}', [NindyBookController::class, 'processBuyNow'])->name('buyNow.process');
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/buy-now', [NindyBookController::class, 'showBuyNowAll'])->name('buyNow.showAll');
    Route::post('/buy-now', [NindyBookController::class, 'processBuyNowAll'])->name('buyNow.processAll');


});
