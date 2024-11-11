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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/product/{product}', [ProductController::class, 'productDetail'])->name('product.details');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/upload', [ProductController::class, 'uploadProduct'])->name('upload');
    Route::post('/upload/product', [ProductController::class, 'upload'])->name('product.upload');
    Route::post('/filter-products', [ProductController::class, 'filterProducts'])->name('products.filter');
    Route::delete('/delete/product/{product}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/edit/product/{product}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::put('/update/product/{product}', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::get('/showAllProducts', [ProductController::class, 'showAllUserProducts'])->name('showAllProducts');
});