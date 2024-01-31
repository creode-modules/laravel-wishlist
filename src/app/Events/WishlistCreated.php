<?php

namespace Creode\LaravelWishlist\app\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WishlistCreated
{
    use SerializesModels, Dispatchable;

    public mixed $wishlist;

    /**
     * Create a new event instance.
     */
    public function __construct($wishlist)
    {
        $this->wishlist = $wishlist;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
