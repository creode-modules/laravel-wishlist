<h1>Your Previous Wishlists</h1>
<div>
    @forelse($wishlists as $wishlist)
        <div style="padding-bottom: 20px;">
            <p>{{ $wishlist->created_at }}</p>

            @forelse($wishlist->wishlistItems as $wishlistItem)
                <div style="background-color: #f1f1f1; padding: 10px; margin-bottom: 10px;">
                    <h4>{{ $wishlistItem->sku }} - {{ $wishlistItem->name }}</h4>
                    <p>Size: {{ $wishlistItem->size }}</p>
                    <p>Colour: {{ $wishlistItem->colour }}</p>
                    <p>Qty: {{ $wishlistItem->quantity }}</p>
                </div>

            @empty
                <p>You do not have any items in your wishlist.</p>
            @endforelse

            <hr>
        </div>

    @empty
        <p>You do not have any items in your wishlist.</p>
@endforelse
</div>
