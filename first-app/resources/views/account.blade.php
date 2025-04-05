@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Account</h2>
    <a href="{{ route('profile.edit') }}">Edit Profile</a>

    <div class="mb-4">
        <h4>Welcome, {{ $user->name }}!</h4>
        <p><strong>Points:</strong> {{ $user->points }}</p>
        <p><strong>Total Bus Bookings:</strong> {{ $total_bus_bookings }}</p>
        <p><strong>Last Booking Date:</strong> {{ $last_bus_booking_date ? $last_bus_booking_date->format('Y-m-d') : 'N/A' }}</p>
    </div>

    <h4>Your Bookings</h4>
    @if($bookings->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking Ref</th>
                    <th>Festival</th>
                    <th>Bus Route</th>
                    <th>Seats</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->festival->name ?? 'N/A' }}</td>
                        <td>{{ $booking->busRoute->id ?? 'N/A' }}</td>
                        <td>{{ $booking->number_of_seats }}</td>
                        <td>€{{ number_format($booking->total_price, 2) }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>{{ ucfirst($booking->payment_status) }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no bookings yet.</p>
    @endif
</div>
@endsection
