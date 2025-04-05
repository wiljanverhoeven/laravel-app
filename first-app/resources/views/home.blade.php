<x-layout>
    <h1>Welcome</h1>

    <form action="{{ route('busroute.create') }}" method="GET">
        <label for="festival">Choose a Festival:</label>
        <select name="festival_id" id="festival" required>
            @foreach($festivals as $festival)
                <option value="{{ $festival->id }}">{{ $festival->name }}</option>
            @endforeach
        </select>

        <button type="submit">Next</button>
    </form>

    <a href='/festivals'>Upcoming festivals</a> </br>

    @guest
        <a href='/login'>Log in</a> </br>
        <a href='/register'>Make an account</a> </br>
    @endguest

    @auth
        <a href="{{ route('account') }}">My Account</a> </br>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a> </br>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
</x-layout>
