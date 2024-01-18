@component('mail::message')
# {{ __('Wishlist') }}

{{ $wishlist->name }} - **{{ $wishlist->business_name }}**

{{ __('Email:') }} {{ $wishlist->email }}

## {{ __('Wishlist Items') }}

@component('mail::table')
| Product                                              | Colour                      | Size                      | Qty                           |
|------------------------------------------------------|-----------------------------|---------------------------|-------------------------------|
@foreach($wishlist->wishlistItems as $wishlistItem)
| {{ $wishlistItem->name }} - {{ $wishlistItem->sku }} | {{ $wishlistItem->colour }} | {{ $wishlistItem->size }} | {{ $wishlistItem->quantity }} |
@endforeach
@endcomponent

@endcomponent
