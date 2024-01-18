<form action="{{ route('wishlist.register.form') }}" method="POST">
    @CSRF

    <label for="organisation">
        I am an organisation
        <input id="organisation" type="radio" name="userType" value="organisation">
    </label>
    <br>
    <label for="embellisher">
        I am an embellisher/printer
        <input id="embellisher" type="radio" name="userType" value="embellisher">
    </label>

    <button type="submit">Submit</button>

</form>
