<?php

namespace Modules\AwdisProductWishlist\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AwdisProductWishlist\Actions\AddItemToWishlist;
use Modules\AwdisProductWishlist\app\Exceptions\ProductAlreadyInWishListException;
use Modules\AwdisProductWishlist\app\Http\Requests\WishlistItemRequest;
use Modules\AwdisProductWishlist\Services\WishlistPdfDownloadService;
use Modules\AwdisProductWishlist\app\Contracts\WishlistStorageInterface;

class AwdisProductWishlistController extends Controller
{

    public function __construct(
        protected WishlistStorageInterface $wishlistStorageService,
        protected WishlistPdfDownloadService $wishlistPdfDownloadService
    )
    {}

    public function showWishlist()
    {
        $wishlist = $this->wishlistStorageService->getWishlist();
        return view('awdisproductwishlist::wishlist', compact('wishlist'));
    }

    public function myWishlists()
    {
        $wishlists = auth()->user()->wishlists->load('wishlistItems');
        return view('awdisproductwishlist::my-wishlists', compact('wishlists'));
    }

    public function addToWishlist(WishlistItemRequest $wishlistItemRequest)
    {
        try{
            AddItemToWishlist::run($wishlistItemRequest->validated());
            return back()->with('message', 'Product added to wishlist. <a href="'.route('wishlist.show').'">View wishlist</a>');
        }catch(ProductAlreadyInWishListException $e){
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
        return view('awdisproductwishlist::thankyou');
    }

}
