@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-center text-white mb-6">My Account</h2>

    <!-- Edit Profile Link -->
    <div class="mb-6 text-center">
        <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Edit Profile</a>
    </div>

    <!-- User Information -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h4 class="text-xl font-semibold mb-2">Welcome, {{ $user->name }}!</h4>
        <p class="text-sm text-gray-600"><strong>Points:</strong> {{ $user->points }}</p>
        <p class="text-sm text-gray-600"><strong>Total Bus Bookings:</strong> {{ $total_bus_bookings }}</p>
        <p class="text-sm text-gray-600"><strong>Last Booking Date:</strong> {{ $last_bus_booking_date ? $last_bus_booking_date->format('Y-m-d') : 'N/A' }}</p>
    </div>

    <!-- User Bookings Table -->
    <h4 class="text-2xl font-semibold mb-4">Your Bookings</h4>

    @if($bookings->count())
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-sm text-gray-600">
                    <tr>
                        <th class="py-2 px-4 border-b">Booking Ref</th>
                        <th class="py-2 px-4 border-b">Festival</th>
                        <th class="py-2 px-4 border-b">Bus Route</th>
                        <th class="py-2 px-4 border-b">Seats</th>
                        <th class="py-2 px-4 border-b">Total Price</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Payment</th>
                        <th class="py-2 px-4 border-b">Date</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $booking->booking_reference }}</td>
                            <td class="py-2 px-4 border-b">{{ $booking->festival->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $booking->busRoute->departure_location ?? 'N/A' }} → {{ $booking->busRoute->arrival_location ?? 'Unknown' }}</td>
                            <td class="py-2 px-4 border-b">{{ $booking->number_of_seats }}</td>
                            <td class="py-2 px-4 border-b">€{{ number_format($booking->total_price, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($booking->status) }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($booking->payment_status) }}</td>
                            <td class="py-2 px-4 border-b">{{ $booking->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-blue-100 p-4 rounded-md text-center">
            <p class="text-lg text-gray-700">You have no bookings yet. <a href="{{ route('festivals') }}" class="text-indigo-600 hover:underline">Browse our upcoming festivals</a> and book your first bus trip!</p>
        </div>
    @endif
</div>
@endsection
