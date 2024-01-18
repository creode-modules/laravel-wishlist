<?php

namespace Modules\AwdisProductWishlist\app\Helpers;

use Modules\AwdisProductWishlist\app\Models\Wishlist;

class WishlistHelper
{

    public function isReturningUser($email)
    {
        return auth()->check() || Wishlist::where('email', $email)->exists();
    }

}
