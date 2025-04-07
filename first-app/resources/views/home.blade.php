@extends('layouts.app')

@section('content')
<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-4xl font-bold text-center text-white mb-8">Welcome to our Festival Travel System</h1>

        <!-- Festival Selection-->
        <div class="festival-selection max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg mb-12">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Choose a Festival</h2>
            <form action="{{ route('busroute.create') }}" method="GET">
                <label for="festival" class="block text-lg font-medium text-gray-700 mb-4">Select Festival:</label>
                <select name="festival_id" id="festival" required class="block w-full p-4 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($festivals as $festival)
                        <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                    Next
                </button>
            </form>
        </div>

      

        <!-- Admin anf upcoming festivals-->
        <div class="auth-links max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg mb-12">
            <div class="links text-center mb-8">
                <a href="{{ route('festivals') }}" class="text-indigo-600 hover:text-indigo-700 text-lg font-medium">Upcoming Festivals</a>
            </div>
            @auth
                <div class="text-center space-y-6">
                    @if(auth()->user()->hasRole('admin'))
                        <p><a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 text-lg font-semibold">Admin Dashboard</a></p>
                    @endif
            @endauth
        </div>
    </div>
</x-layout>
@endsection