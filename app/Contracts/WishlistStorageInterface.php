<?php

namespace Modules\AwdisProductWishlist\app\Contracts;

interface WishlistStorageInterface
{
    public function getWishlist();
    public function addItemToWishlist($wishlistItem);
    public function removeItemFromWishlist($sku);
}
