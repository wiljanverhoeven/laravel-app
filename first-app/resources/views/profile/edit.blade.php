@extends('layouts.app')

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-white text-2xl font-semibold mb-4">Edit Profile</h2>

        @if(session('status'))
            <div class="text-green-500 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-white">Name:</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-white">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white">Password (leave blank to keep current):</label>
                <input 
                    type="password" 
                    name="password" 
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password:</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            <!-- Save Changes-->
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Save Changes
                </button>
            </div>
        </form>

        <!-- Delete Account-->
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
            @csrf
            @method('DELETE')
            <button 
                type="submit" 
                class="w-full py-2 px-4 bg-red-500 text-white rounded-md hover:bg-red-600">Delete Account</button>
        </form>
    </div>
@endsection
