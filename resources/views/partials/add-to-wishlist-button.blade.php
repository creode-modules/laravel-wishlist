<form action="{{ route('wishlist.add', $variant->sku) }}" method="POST">
    @CSRF
    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="sku" value="{{ $variant->sku }}">
    <input type="hidden" name="colour" value="{{ $variant->optionValues[1] }}">
    <input type="hidden" name="size" value="{{ $variant->optionValues[0] }}">
    <input type="hidden" name="image" value="{{ $variant->colourImage }}">
    <input type="hidden" name="quantity" value="10">
    <button type="submit">Add to Wishlist</button>
</form>
