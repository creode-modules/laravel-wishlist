<?php

namespace Modules\AwdisProductWishlist\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Modules\AwdisProductWishlist\app\Contracts\WishlistDownloadInterface;

class WishlistPdfDownloadService implements WishlistDownloadInterface
{

    public function download($wishlist)
    {
        $pdf = PDF::loadView('awdisproductwishlist::pdf.wishlist-pdf', compact('wishlist'));
        return $pdf->download('wishlist.pdf');
    }
}
