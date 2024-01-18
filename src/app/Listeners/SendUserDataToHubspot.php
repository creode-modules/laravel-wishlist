<?php

namespace Creode\LaravelWishlist\app\Listeners;

use Creode\LaravelWishlist\app\Events\WishlistUserRegistered;

class SendUserDataToHubspot
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // Send data to Hubspot
    }
}
