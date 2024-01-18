<?php

namespace Modules\AwdisProductWishlist\app\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\AwdisProductWishlist\app\Events\WishlistUserRegistered;
use Modules\AwdisProductWishlist\app\Listeners\SendUserDataToHubspot;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WishlistUserRegistered::class => [
            SendUserDataToHubspot::class,
        ],
    ];
}
