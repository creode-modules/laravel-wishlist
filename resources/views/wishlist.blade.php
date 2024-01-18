<div style="margin-bottom: 50px;">
    @if (session('message'))
        <div class="alert alert-success">
            {!! session('message') !!}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Your Wishlist</h1>
    <div>

        @forelse($wishlist as $wishlistItem)
            <h4>{{ $wishlistItem->sku }} - {{ $wishlistItem->name }}</h4>
            <p>Size: {{ $wishlistItem->size }}</p>
            <p>Colour: {{ $wishlistItem->colour }}</p>
            <p>Qty: {{ $wishlistItem->quantity }}</p>

            <form action="{{ route('wishlist.remove', $wishlistItem->sku) }}" method="POST">
                @CSRF
                @METHOD('DELETE')
                <button type="submit">Delete</button>
            </form>
        @empty
            <p>You do not have any items in your wishlist.</p>
        @endforelse
    </div>
</div>

<div style="margin-bottom: 50px;">
    <p>If you register an account with AWDis, you can save your wishlist. <a href="#">Register</a></p>
</div>

<p><a href="/products/JH001M">Continue Shopping</a></p>

@if(session()->exists('wishlist.items'))
    @guest
        @include('awdisproductwishlist::user-type')
    @endguest

    @auth
        <form action="{{ route('wishlist.register.form') }}" method="POST">
            @CSRF
            <input type="hidden" name="userType" value="{{ auth()->user()->getRoleNames()->first() }}">
            <button type="submit">Download Wishlist</button>
        </form>
    @endauth
@endif

