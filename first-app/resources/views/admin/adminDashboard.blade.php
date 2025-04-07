@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 space-y-10">

        <!-- Users and Bookings-->
        <x-admin.section title="">
            @forelse ($users as $user)
                <div class="bg-white p-4 rounded shadow-md">
                    <p class="font-semibold text-lg">Users & Bookings</p>
                    <div class="flex justify-between items-center">
                        <p class="font-semibold text-lg">{{ $user->name }} ({{ $user->email }})</p>
                        <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    </div>

                    <!-- Booking List -->
                    <ul class="list-disc pl-5">
                        @if ($user->bookings->count() > 3)
                            <div class="max-h-40 overflow-y-auto">
                                @foreach ($user->bookings as $booking)
                                    <li>
                                        <strong>Festival:</strong> {{ $booking->festival->id ?? 'N/A' }},
                                        <strong>Bus:</strong> {{ $booking->busRoute->departure_date ?? 'N/A' }},
                                        <strong>Date:</strong> {{ $booking->created_at->format('Y-m-d') }}
                                    </li>
                                @endforeach
                            </div>
                        @else
                            @foreach ($user->bookings as $booking)
                                <li>
                                    <strong>Festival:</strong> {{ $booking->festival->id ?? 'N/A' }},
                                    <strong>Bus:</strong> {{ $booking->busRoute->departure_date ?? 'N/A' }},
                                    <strong>Date:</strong> {{ $booking->created_at->format('Y-m-d') }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @empty
                <p>No users available.</p>
            @endforelse
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </x-admin.section>

        <!-- Festivals -->
        <x-admin.section title="">
            <div class="bg-white p-4 rounded shadow-md">
            <p class="font-semibold text-lg">Manage Festivals</p>
            <a href="{{ route('admin.festivals.create') }}" class="btn-blue mb-4 inline-block">Add Festival</a>
                @forelse ($festivals as $festival)
                    <div class="bg-gray-100 p-4 rounded mb-3 flex justify-between items-center">
                        <span>{{ $festival->name }}</span>
                        <a href="{{ route('admin.festivals.edit', $festival) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    </div>
                @empty
                    <p>No festivals available. Please add some festivals.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $festivals->links() }}
            </div>
        </x-admin.section>

        <!-- Bus Routes-->
        <x-admin.section title="">
            <div class="bg-white p-4 rounded shadow-md">
                <p class="font-semibold text-lg">Manage Bus Routes</p>
                <a href="{{ route('admin.busroutes.create') }}" class="btn-green mb-4 inline-block">Add Bus Route</a>
                @forelse ($busRoutes as $route)
                    <div class="bg-gray-100 p-4 rounded mb-3 flex justify-between items-center">
                        <span>{{ $route->departure_date }} → {{ $route->arrival_date }} {{ $route->festival->name ?? 'No Festival' }} from {{ $route->departure_location }}</span>
                        <a href="{{ route('admin.busroutes.edit', $route) }}" class="text-green-500 hover:text-green-700">Edit</a>
                    </div>
                @empty
                    <p>No bus routes available. Please add some routes.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $busRoutes->links() }}
            </div>
        </x-admin.section>

    </div>
@endsection
