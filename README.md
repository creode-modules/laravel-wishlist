# Laravel Wishlist

## Installation
Run the following command:
```bash
composer require "creode/laravel-wishlist"
```

Publish the config, migrations, views and routes by running the following command.
```bash
php artisan vendor:publish --tag=laravel-wishlist
```

Add the following Classes to your Kernel.php file:
```php
protected $middleware = [
        //...
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
];
```

Set the **SESSION_DRIVER** config variable in your .env file to `database`:
```dotenv
SESSION_DRIVER=database
```

Then run the following commands to create the session table and migrate the database:
```bash
php artisan session:table
 
php artisan migrate
```
