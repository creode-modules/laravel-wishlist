<?php

namespace Modules\AwdisProductWishlist\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Modules\AwdisProductWishlist\app\Contracts\WishlistStorageInterface;
use Modules\AwdisProductWishlist\app\Exceptions\MissingDataFromWishlistItem;
use Modules\AwdisProductWishlist\app\Exceptions\ProductAlreadyInWishListException;
use Modules\AwdisProductWishlist\app\Models\WishlistItem;

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
