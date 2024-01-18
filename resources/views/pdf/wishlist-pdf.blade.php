<div style="margin-bottom: 50px;">
    <h1>Your Wishlist</h1>
    @foreach($wishlist as $wishlistItem)
        <h4>{{ $wishlistItem->sku }} - {{ $wishlistItem->name }}</h4>
        <p>Size: {{ $wishlistItem->size }}</p>
        <p>Colour: {{ $wishlistItem->colour }}</p>
        <p>Quantity: {{ $wishlistItem->quantity }}</p>
    @endforeach
</div>
