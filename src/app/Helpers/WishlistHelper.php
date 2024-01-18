<?php

namespace Creode\LaravelWishlist\app\Helpers;

use Creode\LaravelWishlist\app\Models\Wishlist;

class WishlistHelper
{

    public function isReturningUser($email)
    {
        return auth()->check() || Wishlist::where('email', $email)->exists();
    }

}
