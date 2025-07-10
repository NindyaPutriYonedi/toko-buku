<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\NindyAuthController;
use App\Http\Controllers\NindyBookController;
use App\Http\Controllers\NindyOrderController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NindyHistoryController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCustomerController;

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
//Route::post('/buy-now/{id}', [NindyBookController::class, 'processBuyNow'])->name('buyNow');
 Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
 Route::get('/buy-now', [NindyBookController::class, 'showBuyNowAll'])->name('buyNow.showAll');
        Route::post('/buy-now', [NindyBookController::class, 'processBuyNowAll'])->name('buyNow.processAll');


});

Route::get('/book/{id}', [NindyBookController::class, 'show'])->name('book.show');

// Route::middleware(['auth', AdminMiddleware::class])
//     ->prefix('admin')
//     ->group(function () {
//         Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
//         Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books');
//         Route::get('/customers', [AdminCustomerController::class, 'index'])->name('admin.customers');
//     });

// Route::middleware(['auth', AdminMiddleware::class])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::get('/books', [AdminBookController::class, 'index'])->name('books');
//         Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
//         Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
//         Route::get('/books/{id}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
//         Route::put('/books/{id}', [AdminBookController::class, 'update'])->name('books.update');
//         Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');
//     });

    Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::get('/books', [AdminBookController::class, 'index'])->name('books');
        Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
        Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
        Route::get('/books/{id}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{id}', [AdminBookController::class, 'update'])->name('books.update');
        Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers');
        Route::resource('categories', AdminCategoryController::class)->names('admin.categories');
        Route::resource('categories', AdminCategoryController::class);

//Route::resource('customers', AdminCustomerController::class)->only(['index', 'destroy']);


    });

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('admin/orders/{id}/status', [NindyOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

});








