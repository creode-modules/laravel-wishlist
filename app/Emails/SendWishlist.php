<?php

namespace Modules\AwdisProductWishlist\app\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWishlist extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $wishlist;

    public function __construct($wishlist)
    {
        $this->wishlist = $wishlist;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->markdown('awdisproductwishlist::email.wishlist', ['wishlist' => $this->wishlist])
            ->subject('New Wishlist')
            ->from(config('awdisproductwishlist.sender.email'), config('awdisproductwishlist.sender.name'));
    }
}
