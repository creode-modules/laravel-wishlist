<?php

namespace Creode\LaravelWishlist\app\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Creode\LaravelWishlist\app\Events\WishlistUserRegistered;
use Creode\LaravelWishlist\app\Listeners\SendUserDataToHubspot;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WishlistUserRegistered::class => [
            SendUserDataToHubspot::class,
        ],
    ];
}
