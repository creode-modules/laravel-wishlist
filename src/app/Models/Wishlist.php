<?php

namespace Creode\LaravelWishlist\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'name',
        'business_name',
        'email'
    ];

    public function wishlistItems()
    {
        return $this->belongsToMany(WishlistItem::class, 'wishlist_wishlist_items', 'wishlist_id', 'wishlist_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
