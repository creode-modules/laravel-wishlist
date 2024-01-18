<?php

namespace Creode\LaravelWishlist;

use App\Models\User;
use Creode\LaravelWishlist\app\Contracts\WishlistDownloadInterface;
use Creode\LaravelWishlist\app\Contracts\WishlistStorageInterface;
use Creode\LaravelWishlist\app\Models\Wishlist;
use Creode\LaravelWishlist\Services\SessionStorageService;
use Creode\LaravelWishlist\Services\WishlistPdfDownloadService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelWishlistServiceProvider extends PackageServiceProvider
{

    public function boot()
    {
        $this->registerRelationships();

        $this->app->bind(WishlistStorageInterface::class, SessionStorageService::class);
        $this->app->bind(WishlistDownloadInterface::class, WishlistPdfDownloadService::class);
    }

    private function registerRelationships(): void
    {
        User::resolveRelationUsing('wishlists', function ($user) {
            return $user->hasMany(Wishlist::class);
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-wishlist')
            ->hasViews('laravel-wishlist')
            ->hasRoutes('web')
            ->hasConfigFile('laravel-wishlist')
            ->hasMigrations(
                [
                    '2023_11_14_160232_create_sessions_table',
                    '2023_11_15_153847_add_business_name_to_users_table',
                    '2023_11_16_165036_create_wishlist_items_table',
                    '2023_11_16_165523_create_wishlists_table',
                    '2023_11_17_090746_create_wishlist_wishlist_items_table',
                    '2023_12_14_144050_make_image_field_nullable_on_wishlist_items_table',
                ]
            )
            ->runsMigrations();
    }
}
