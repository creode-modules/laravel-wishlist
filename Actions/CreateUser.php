<?php

namespace Modules\AwdisProductWishlist\Actions;

use App\Models\User;
use Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function handle($data)
    {
        try {
            $user = User::create($data);
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        $user->assignRole('organisation');
        Auth::login($user);
    }

}
