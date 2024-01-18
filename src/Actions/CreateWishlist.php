<?php

namespace Creode\LaravelWishlist\Actions;

use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;
use Creode\LaravelWishlist\app\Models\Wishlist;
use Creode\LaravelWishlist\app\Models\WishlistItem;
use Lorisleiva\Actions\Concerns\AsAction;

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
