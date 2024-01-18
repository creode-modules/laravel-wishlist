<?php

namespace Modules\AwdisProductWishlist\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Modules\AwdisProductWishlist\app\Contracts\WishlistStorageInterface;
use Modules\AwdisProductWishlist\app\Models\Wishlist;
use Modules\AwdisProductWishlist\app\Models\WishlistItem;

class CreateWishlist
{
    use asAction;

    public function __construct(protected WishlistStorageInterface $wishlistStorageService,)
    {}

    public function handle($userData)
    {
        // Create Wishlist
        $wishlist = Wishlist::create([
            'user_id' => auth()->user()->id ?? null,
            'name' => $userData['name'],
            'business_name' => $userData['business_name'],
            'email' => $userData['email']
        ]);

        // Get wishlist items from session
        $wishlistFromSession = $this->wishlistStorageService->getWishlist();

        // Create wishlist items and add them to the user's wishlist
        foreach ($wishlistFromSession as $wishlistItem) {
            $wishlistItem = WishlistItem::firstOrCreate(
                ['sku' => $wishlistItem->sku],
                [
                    'name' => $wishlistItem->name,
                    'size' => $wishlistItem->size,
                    'colour' => $wishlistItem->colour,
                    'image' => $wishlistItem->image,
                    'quantity' => $wishlistItem->quantity
                ]
            );

            $wishlistItem->wishlist()->attach($wishlist->id);
        }

        return $wishlist;
    }

}
