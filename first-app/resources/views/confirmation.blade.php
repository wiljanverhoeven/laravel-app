@extends('layouts.app')

@section('content')
    <x-admin.section title="Booking Confirmed!">
        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4 text-gray-700">Thank you for your booking. Below are the details of your reservation:</p>

            <!-- Booking Details-->
            <div class="space-y-4">
                <div>
                    <strong class="text-gray-800">Booking Reference:</strong> 
                    <span class="font-medium text-gray-900">{{ $booking->booking_reference }}</span>
                </div>

                @if ($booking->festival)
                    <div>
                        <strong class="text-gray-800">Festival:</strong> 
                        <span class="font-medium text-gray-900">{{ $booking->festival->name }}</span>
                    </div>
                @else
                    <div class="text-red-500">
                        <strong>Festival:</strong> Not Found
                    </div>
                @endif

                @if ($booking->busRoute)
                    <div>
                        <strong class="text-gray-800">Bus Route:</strong> 
                        <span class="font-medium text-gray-900">{{ $booking->busRoute->departure_location }} → {{ $booking->festival->name ?? 'Unknown' }}</span>
                    </div>
                @else
                    <div class="text-red-500">
                        <strong>Bus Route:</strong> Not Found
                    </div>
                @endif

                <div>
                    <strong class="text-gray-800">Number of Seats:</strong> 
                    <span class="font-medium text-gray-900">{{ $booking->number_of_seats }}</span>
                </div>

                <div>
                    <strong class="text-gray-800">Total Price:</strong> 
                    <span class="font-medium text-gray-900">${{ number_format($booking->total_price, 2) }}</span>
                </div>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Back to Home
                </a>
            </div>
        </div>
    </x-admin.section>
@endsection
