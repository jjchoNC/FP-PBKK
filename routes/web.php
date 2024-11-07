<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'seller') {
            return view('SellerDashboard');
        } elseif (Auth::user()->role == 'user') {
            return view('UserDashboard');
        }
    }
    return redirect()->route('login');
})->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::post('/upload/product', [ProductController::class, 'upload'])->middleware('auth')->name('product.upload');
