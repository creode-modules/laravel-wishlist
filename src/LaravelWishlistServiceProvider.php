<?php

namespace Creode\LaravelWishlist;

use App\Models\User;
use Creode\LaravelWishlist\app\Contracts\WishlistDownloadInterface;
use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;
use Creode\LaravelWishlist\app\Models\Wishlist;
use Creode\LaravelWishlist\Services\SessionStorageService;
use Creode\LaravelWishlist\Services\WishlistPdfDownloadService;
use Illuminate\Support\ServiceProvider;

class LaravelWishlistServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerRelationships();

        $this->app->bind(WishlistStorageInterface::class, SessionStorageService::class);
        $this->app->bind(WishlistDownloadInterface::class, WishlistPdfDownloadService::class);

        $this->publishes([
            __DIR__.'/../config/laravel-wishlist.php' => config_path('laravel-wishlist.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-wishlist');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/wishlist'),
        ]);
    }

    private function registerRelationships(): void
    {
        User::resolveRelationUsing('wishlists', function ($user) {
            return $user->hasMany(Wishlist::class);
        });
    }


}
