<?php

namespace Creode\LaravelWishlist\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Creode\LaravelWishlist\Actions\AddItemToWishlist;
use Creode\LaravelWishlist\app\Exceptions\ProductAlreadyInWishListException;
use Creode\LaravelWishlist\app\Http\Requests\WishlistItemRequest;
use Creode\LaravelWishlist\Services\WishlistPdfDownloadService;
use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;

class LaravelWishlistController extends Controller
{

    public function __construct(
        protected WishlistStorageInterface $wishlistStorageService,
        protected WishlistPdfDownloadService $wishlistPdfDownloadService
    )
    {
    }

    public function showWishlist()
    {
        $wishlist = $this->wishlistStorageService->getWishlist();
        return view('laravel-wishlist::wishlist', compact('wishlist'));
    }

    public function myWishlists()
    {
        $wishlists = auth()->user()->wishlists->load('wishlistItems');
        return view('laravel-wishlist::my-wishlists', compact('wishlists'));
    }

    public function addToWishlist(WishlistItemRequest $wishlistItemRequest)
    {
        try {
            AddItemToWishlist::run($wishlistItemRequest->validated());
            return back()->with('message', 'Product added to wishlist. <a href="'.route('wishlist.show').'">View wishlist</a>');
        } catch (ProductAlreadyInWishListException $e) {
            return back()->with('message', $e->getMessage());
        }
    }

    public function removeFromWishlist($sku)
    {
        $this->wishlistStorageService->removeItemFromWishlist($sku);
        return back()->with('message', 'Product removed from wishlist.');
    }

    public function pdfDownload()
    {
        $wishlist = $this->wishlistStorageService->getWishlist();
        session()->forget('wishlist.items');
        return $this->wishlistPdfDownloadService->download($wishlist);
    }

    public function thankYou()
    {
        return view('laravel-wishlist::thankyou');
    }
}
