<?php

namespace Creode\LaravelWishlist\Services;

use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;
use Creode\LaravelWishlist\app\Exceptions\ProductAlreadyInWishListException;

class SessionStorageService implements WishlistStorageInterface
{

    public function getWishlist()
    {
        if(empty($wishlist)){
            $wishlist = [];
        }

        if(session()->exists('wishlist.items')){
            $wishlist = session()->get('wishlist.items');
        }

        return $wishlist;
    }

    public function wishlistExists()
    {
        return session()->exists('wishlist.items');
    }

    public function userHasWishlistItems()
    {
        return $this->getWishlist() !== [];
    }

    public function itemInWishlist($wishlistItem)
    {
        return in_array($wishlistItem, $this->getWishlist());
    }

    public function addItemToWishlist($wishlistItem)
    {
        // If user is logged out and session wishlist does not exist, then create a wishlist in session and add wishlist item to wishlist
        if (!session()->exists('wishlist.items')) {
            $this->createWishlist([$wishlistItem]);
            return;
        }

        // If wishlist item is not in session wishlist, then add wishlist item with session wishlist.
        if(!$this->itemInWishlist($wishlistItem)) {
            session()->push('wishlist.items', $wishlistItem);
            return;
        }

        // If wishlist item is in session wishlist, throw an exception
        if($this->itemInWishlist($wishlistItem)){
            $this->productAlreadyInWishlist();
        }
    }

    public function removeItemFromWishlist($sku)
    {
        $wishlist = $this->getWishlist();
        $wishlist = array_filter($wishlist, function($item) use ($sku) {
            return $item->sku != $sku;
        });

        $this->createWishlist($wishlist);

        return $wishlist;
    }

    public function createWishlist($wishlistItems)
    {
        session()->put('wishlist.items', $wishlistItems);
    }

    private function productAlreadyInWishlist()
    {
        throw new ProductAlreadyInWishListException('Product already in wishlist.');
    }
}
