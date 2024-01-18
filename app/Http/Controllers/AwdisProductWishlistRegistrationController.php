<?php

namespace Modules\AwdisProductWishlist\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\AwdisProductWishlist\Actions\CreateUser;
use Modules\AwdisProductWishlist\Actions\CreateWishlist;
use Modules\AwdisProductWishlist\app\Emails\SendWishlist;
use Modules\AwdisProductWishlist\app\Events\WishlistUserRegistered;
use Modules\AwdisProductWishlist\app\Helpers\WishlistHelper;
use Modules\AwdisProductWishlist\app\Http\Requests\UserRegistrationFormRequest;
use Modules\AwdisProductWishlist\app\Http\Requests\UserTypeRequest;

class AwdisProductWishlistRegistrationController extends Controller
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
        return view('awdisproductwishlist::register', ['type' => $validated['userType']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegistrationFormRequest $userRegistrationFormRequest)
    {
        // Set a flag to session to check if user has submitted registration form
        $userData = $userRegistrationFormRequest->validated();

        // Create a new user if register was ticked
        if($userRegistrationFormRequest->has('register')){
            CreateUser::run($userData);

            // Details sent to HubSpot
            WishlistUserRegistered::dispatch($userData);
        }

        $wishlist = CreateWishlist::run($userData);

        // Returning customer
        if($this->wishlistHelper->isReturningUser($userData['email'])){
            // Send email to AWDis
            $wishlist->load('wishlistItems');
            Mail::to(config('awdisproductwishlist.recipient.email'))
                ->send(new SendWishlist($wishlist));
        }

        // Redirect to thank you page
        return redirect()->route('wishlist.thankyou');
    }
}
