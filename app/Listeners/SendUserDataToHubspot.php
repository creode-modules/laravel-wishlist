<?php

namespace Modules\AwdisProductWishlist\app\Listeners;

use Modules\AwdisProductWishlist\app\Events\WishlistUserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
