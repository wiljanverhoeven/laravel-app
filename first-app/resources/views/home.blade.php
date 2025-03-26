<x-layout>
    <h1>Welcome</h1>
    <a href='/busses'>Busses</a> </br>
    <a href='/festivals'>Upcoming festivals</a> </br>
    <a href='/login'>log in</a> </br>
    <a href='/register'>Make an account</a> </br>
    <a href="{{ route('logout') }}" 
    onclick="event.preventDefault(); 
    document.getElementById('logout-form').submit();">
    Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</x-layout>