Please click the button below to download you PDF wishlist
<form action="{{ route('wishlist.download.pdf') }}" method="POST">
    @CSRF
    <button type="submit">Download Wishlist</button>
</form>
