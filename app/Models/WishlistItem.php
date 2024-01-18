<?php

namespace Modules\AwdisProductWishlist\app\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'sku',
        'colour',
        'size',
        'image',
        'quantity',
    ];

    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class, 'wishlist_wishlist_items', 'wishlist_item_id', 'wishlist_id');
    }

}
