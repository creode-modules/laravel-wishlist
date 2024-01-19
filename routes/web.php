<?php

use Creode\LaravelWishlist\app\Http\Controllers\LaravelWishlistController;
use Creode\LaravelWishlist\app\Http\Controllers\LaravelWishlistRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('wishlist')->group(function () {

    Route::get('/', [LaravelWishlistController::class, 'showWishlist'])->name('wishlist.show');
    Route::post('add', [LaravelWishlistController::class, 'addToWishlist'])->name('wishlist.add');

    Route::middleware('auth')->group(function () {
        Route::get('my-wishlists', [LaravelWishlistController::class, 'myWishlists'])->name('wishlist.previous');
    });

    Route::middleware('wishlist')->group(function () {
        Route::delete('remove/{id}', [LaravelWishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
        Route::post('register', [LaravelWishlistRegistrationController::class, 'create'])->name('wishlist.register.form');
        Route::post('submit', [LaravelWishlistRegistrationController::class, 'store'])->name('wishlist.download.submit');
        Route::post('pdf-download', [LaravelWishlistController::class, 'pdfDownload'])->name('wishlist.download.pdf');
        Route::get('thank-you', [LaravelWishlistController::class, 'thankYou'])->name('wishlist.thankyou');
    });
});
