@extends('layouts.app')

@section('content')
    <x-admin.section title="Confirm Your Booking">
        <!-- Display Error-->
        @if(session('error'))
            <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded-lg">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Booking Details-->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Booking Details</h2>
            <div class="booking-item mb-3">
                <strong class="text-gray-800">Festival:</strong> {{ $booking['festival_id'] }}
            </div>
            <div class="booking-item mb-3">
                <strong class="text-gray-800">Bus Route:</strong> {{ $booking['bus_route_id'] }}
            </div>
            <div class="booking-item mb-3">
                <strong class="text-gray-800">Seats:</strong> {{ $booking['seats'] }}
            </div>
        </div>

        <!-- User Points-->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Your Current Points</h3>
            <p class="text-gray-700">Your current points: <strong>{{ $userPoints }}</strong></p>
        </div>
        <form action="{{ route('process.payment') }}" method="POST" class="payment-form bg-white shadow-md rounded-lg p-6">
            @csrf

            <!-- Points Discount-->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Use Points for Discount</h3>
                <div class="points-discount">
                    @if($canUsePoints)
                        <p class="text-gray-700 mb-4">You have enough points to use for a 30% discount (10 points required).</p>
                        <label for="use_points" class="flex items-center space-x-2">
                            <input type="checkbox" name="use_points" id="use_points" value="1"
                                class="h-5 w-5 text-indigo-600 border-gray-300 rounded">
                            <span class="text-gray-700">Use points for discount?</span>
                        </label>
                        <input type="hidden" name="use_points" value="0">
                    @else
                        <p class="text-gray-700">You don't have enough points to use for a discount.</p>
                    @endif
                </div>
            </div>

            <div class="form-actions flex justify-end">
                <button type="submit" class="btn btn-primary py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">
                    Proceed to Payment
                </button>
            </div>
        </form>
        </div>
    </x-admin.section>
@endsection
