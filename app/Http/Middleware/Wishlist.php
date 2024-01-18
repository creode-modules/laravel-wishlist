<?php

namespace Modules\AwdisProductWishlist\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\AwdisProductWishlist\app\Contracts\WishlistStorageInterface;

class Wishlist
{
    public function __construct(protected WishlistStorageInterface $wishlistStorageService)
    {}
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // If user does not have a wishlist, redirect to products page
        if(!$this->wishlistStorageService->wishlistExists()) {
            return back()->with('message', 'You do not have a wishlist. Please add items to your wishlist before proceeding.');
        }

        // If user is logged out and has an empty wishlist, redirect to products page
        if(!$this->wishlistStorageService->userHasWishlistItems()){
            return back()->with('message', 'You do not have any items in your wishlist. Please add items to your wishlist before proceeding.');
        }

        return $next($request);
    }
}
