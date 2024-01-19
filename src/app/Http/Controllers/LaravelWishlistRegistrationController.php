<?php

namespace Creode\LaravelWishlist\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Creode\LaravelWishlist\Actions\CreateUser;
use Creode\LaravelWishlist\Actions\CreateWishlist;
use Creode\LaravelWishlist\app\Emails\SendWishlist;
use Creode\LaravelWishlist\app\Events\WishlistUserRegistered;
use Creode\LaravelWishlist\app\Helpers\WishlistHelper;
use Creode\LaravelWishlist\app\Http\Requests\UserRegistrationFormRequest;
use Creode\LaravelWishlist\app\Http\Requests\UserTypeRequest;

class LaravelWishlistRegistrationController extends Controller
{
    public function __construct(protected WishlistHelper $wishlistHelper)
    {
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(UserTypeRequest $userTypeRequest)
    {

        $validated = $userTypeRequest->validated();

        session()->put('userType', $validated['userType']);
        return view('laravel-wishlist::register', ['type' => $validated['userType']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegistrationFormRequest $userRegistrationFormRequest)
    {
        // Set a flag to session to check if user has submitted registration form
        $userData = $userRegistrationFormRequest->validated();

        // Create a new user if register was ticked
        if ($userRegistrationFormRequest->has('register')) {
            CreateUser::run($userData);

            // Details sent to HubSpot
            WishlistUserRegistered::dispatch($userData);
        }

        $wishlist = CreateWishlist::run($userData);

        // Returning customer
        if ($this->wishlistHelper->isReturningUser($userData['email'])) {
            // Send email to AWDis
            $wishlist->load('wishlistItems');
            Mail::to(config('laravel-wishlist.recipient.email'))
                ->send(new SendWishlist($wishlist));
        }

        // Redirect to thank you page
        return redirect()->route('wishlist.thankyou');
    }
}
