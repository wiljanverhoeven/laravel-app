@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <x-admin.section title="Edit User" class="text-white">
            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Name -->
                <x-form.input name="name" label="Name" :value="$user->name" class="bg-gray-700 text-white" />

                <!-- Email -->
                <x-form.input name="email" label="Email" type="email" :value="$user->email" class="bg-gray-700 text-white" />

                <!-- Points -->
                <x-form.input name="points" label="Loyalty Points" type="number" min="0" :value="$user->points" class="bg-gray-700 text-white" />

                <!-- Submit Button -->
                <x-form.button class="bg-blue-500 hover:bg-blue-600">Update User</x-form.button>
            </form>

            <!-- Delete User Form -->
            <form action="{{ route('users.destroy', $user) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <x-form.button class="bg-red-500 hover:bg-red-600">Delete User</x-form.button>
            </form>
        </x-admin.section>
    </div>
@endsection