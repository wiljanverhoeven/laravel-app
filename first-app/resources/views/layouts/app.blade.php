<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        <div class="text-lg font-semibold">
                            <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-700">Home</a>
                        </div>

                        <div class="flex space-x-4">
                            @auth
                                <p class="text-indigo-600">Welcome, {{ auth()->user()->name }}!</p>
                                <a href="{{ route('account') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">My Account</a>
                                <a href="{{ route('logout') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Log in</a>
                                <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Create an account</a>
                            @endguest
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
