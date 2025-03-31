<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BusRoute;


class BookingController extends Controller
{
   
    public function index()
    {
        
    }

   
    public function create()
    {
        
    }

    public function payment()
    {
        // Retrieve booking data from session
        $booking = session('booking');

        // Check if session has booking details
        if (!$booking) {
            return redirect()->route('busses')->with('error', 'No booking found. Please select a bus first.');
        }

        return view('payment', compact('booking'));
    }


    public function processPayment()
    {
        $bookingData = session('booking');

        if (!$bookingData) {
            return redirect()->route('busses')->with('error', 'No booking found. Please start again.');
        }

 
        $busRoute = BusRoute::findOrFail($bookingData['bus_route_id']);

 
        $totalPrice = $busRoute->price * $bookingData['seats'];


        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->festival_id = $bookingData['festival_id'];
        $booking->bus_route_id = $bookingData['bus_route_id'];
        $booking->number_of_seats = $bookingData['seats'];
        $booking->booking_reference = strtoupper(bin2hex(random_bytes(5)));
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';
        $booking->total_price = $totalPrice;
        $booking->save();

        session()->forget('booking');

        return redirect()->route('dashboard')->with('success', 'Booking confirmed!');
    }


   
    public function store(Request $request)
    {
        $request->validate([
            'festival_id' => 'required|exists:festivals,id',
            'bus_route_id' => 'required|exists:bus_routes,id',
            'seats' => 'required|integer|min:1',
        ]);
    
        // Store booking details in session before payment
        session([
            'booking' => [
                'festival_id' => $request->festival_id,
                'bus_route_id' => $request->bus_route_id,
                'seats' => $request->seats,
            ]
        ]);
    
        // Redirect to the payment page
        return redirect()->route('payment');
    }

   
    public function show(string $id)
    {
        
    }

   
    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        
    }

   
    public function destroy(string $id)
    {
    
    }
}
