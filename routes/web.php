<?php

use Illuminate\Support\Facades\Route;

use Modules\AwdisProductWishlist\app\Http\Controllers\AwdisProductWishlistController;
use \Modules\AwdisProductWishlist\app\Http\Controllers\AwdisProductWishlistRegistrationController;


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

Route::prefix('wishlist')->group(function(){

    Route::get('/', [AwdisProductWishlistController::class, 'showWishlist'])->name('wishlist.show');
    Route::post('add', [AwdisProductWishlistController::class, 'addToWishlist'])->name('wishlist.add');

    Route::middleware('auth')->group(function(){
        Route::get('my-wishlists', [AwdisProductWishlistController::class, 'myWishlists'])->name('wishlist.previous');
    });

    Route::middleware('wishlist')->group(function(){
        Route::delete('remove/{id}', [AwdisProductWishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
        Route::post('register', [AwdisProductWishlistRegistrationController::class, 'create'])->name('wishlist.register.form');
        Route::post('submit', [AwdisProductWishlistRegistrationController::class, 'store'])->name('wishlist.download.submit');
        Route::post('pdf-download', [AwdisProductWishlistController::class, 'pdfDownload'])->name('wishlist.download.pdf');
        Route::get('thank-you', [AwdisProductWishlistController::class, 'thankYou'])->name('wishlist.thankyou');
    });

});
