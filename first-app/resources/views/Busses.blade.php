@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-6">Choose Your Bus for {{ $festival->name }}</h1>

                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="festival_id" value="{{ $festival->id }}">

                        <!-- Bus Route Selection -->
                        <div>
                            <label for="bus_route" class="block font-medium text-white">Choose a bus:</label>
                            <select name="bus_route_id" id="bus_route" class="w-full bg-white border-white rounded-lg text-black" required>
                                <option value="">Select a Route</option>
                                @foreach ($busRoutes as $busRoute)
                                    <option value="{{ $busRoute->id }}">
                                        {{ $busRoute->departure_location }} → {{ $festival->name }}
                                        (Arrives: {{ \Carbon\Carbon::parse($busRoute->arrival_date)->format('d M Y, H:i') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('bus_route_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Seat Selection -->
                        <div>
                            <label for="seats" class="block font-medium text-white">Number of seats:</label>
                            <input type="number" name="seats" id="seats" min="1" class="w-full border-white rounded-lg bg-white text-black" required>
                            @error('seats')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
