<?php

namespace Creode\LaravelWishlist\Actions;

use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;
use Creode\LaravelWishlist\app\Exceptions\MissingDataFromWishlistItem;
use Creode\LaravelWishlist\app\Models\WishlistItem;
use Lorisleiva\Actions\Concerns\AsAction;

class AddItemToWishlist
{
    use AsAction;

    public function __construct(
        protected WishlistStorageInterface $wishlistStorageService,
    )
    {}

    public function handle($data)
    {

        try {
            $wishlistItem = new WishlistItem;

            $wishlistItem->name = $data['name'];
            $wishlistItem->sku = $data['sku'];
            $wishlistItem->size = $data['size'];
            $wishlistItem->colour = $data['colour'];
            $wishlistItem->image = $data['image'];
            $wishlistItem->quantity = $data['quantity'];
        }catch (\Exception $e) {
            throw new MissingDataFromWishlistItem('Something went wrong. Please try again.');
        }

        $this->wishlistStorageService->addItemToWishlist($wishlistItem);

    }

}
