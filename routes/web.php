<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

Route::get('/', [ProductController::class, 'LandingPageProduct'])->name('Landing');

Route::get('/register', function () {
    $capitalWord = ucfirst('register');
    ## TEST ##
    return view($capitalWord);
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    $capitalWord = ucfirst('login');
    ## TEST ##
    return view($capitalWord);
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('/product/{product}', [ProductController::class, 'productDetail'])->name('product.details');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/upload', [ProductController::class, 'uploadProduct'])->name('upload');
    Route::post('/upload/product', [ProductController::class, 'upload'])->name('product.upload');

    Route::post('/filter-products', [ProductController::class, 'filterProducts'])->name('products.filter');
    Route::delete('/delete/product/{product}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/edit/product/{product}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::put('/update/product/{product}', [ProductController::class, 'updateProduct'])->name('product.update');

    Route::get('/showAllProducts', [ProductController::class, 'showAllProducts'])->name('products.showAll');

    Route::post('/wishlist/add/{product}', [ShopController::class, 'addWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [ShopController::class, 'removeWishlist'])->name('wishlist.remove');
    Route::get('/wishlist', [ShopController::class, 'showWishlist'])->name('wishlist.show');

    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::delete('/cart/remove/{product}', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::delete('/cart/remove_in_user_cart/{product}', [CartController::class, 'removeCart_in_user_cart'])->name('cart.remove_in_user_cart');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

    Route::get('/scanningPet', [ProductController::class, 'landing_page_for_scan_pet'])->name('scanningPet.show');
    Route::post('/scanningPet', [ProductController::class, 'scan_pet'])->name('upload.pet');

    Route::get('/profile', [ProductController::class, 'userProfile'])->name('profile');

    Route::get('/adoptedPets', [HistoryController::class, 'show'])->name('adoptedPets.show');
});
