<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wishlist.download.submit') }}" method="POST">
        @CSRF
        <p>
            <label for="name">Name
                <input type="text" name="name" id="name">
            </label>
        </p>
        <p>
            <label for="email">Email
                <input type="email" name="email" id="email">
            </label>
        </p>
        <p>
            <label for="organisation">Business Name
                <input type="text" name="business_name" id="business_name">
            </label>
        </p>
        <p>
            <label for="register">Register for an account
                <input type="checkbox" name="register" id="register">
                <p><small>Register for an account with AWDis and get access to our HUB, save your future wishlists and receive exclusive updates.</small></p>
            </label>
        </p>
        <p>
            <label for="password">Password
                <input type="password" name="password" id="password">
            </label>
        </p>
        <p>
            <label for="password_confirm">Confirm Password
                <input type="password" name="password_confirmation" id="password_confirmation">
            </label>
        </p>

        @if($type == 'embellisher')
            <div>
                <p>Would you like to send your order to one of our distributors?</p>
                <label for="distributors">Ralawise
                    <input type="checkbox" name="distributors[]" value="Ralawise" id="distributors">
                </label><br>
                <label for="distributors">Pencarrie
                    <input type="checkbox" name="distributors[]" value="Pencarrie" id="distributors">
                </label><br>
                <label for="distributors">Prestige Leisure
                    <input type="checkbox" name="distributors[]" value="Prestige Leisure" id="distributors">
                </label><br>
                <label for="distributors">No / Don't Know
                    <input type="checkbox" name="distributors[]" value="" id="distributors">
                </label>
            </div>
        @endif

        <p>
            <button type="submit">Submit</button>
        </p>
    </form>
</div>
