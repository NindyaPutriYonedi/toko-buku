<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NindyAuthController;
use App\Http\Controllers\NindyBookController;

Route::get('/', [NindyBookController::class, 'index'])->name('books.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [NindyAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [NindyAuthController::class, 'login']);
    Route::get('/register', [NindyAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [NindyAuthController::class, 'register']);
});

Route::post('/logout', [NindyAuthController::class, 'logout'])->middleware('auth')->name('logout');
