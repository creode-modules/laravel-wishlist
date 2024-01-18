<?php

namespace Creode\LaravelWishlist\app\Contracts;

interface WishlistStorageInterface
{
    public function getWishlist();
    public function addItemToWishlist($wishlistItem);
    public function removeItemFromWishlist($sku);
}
