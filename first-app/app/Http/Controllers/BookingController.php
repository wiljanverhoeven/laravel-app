<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BusRoute;
use App\Models\Festival;
use Illuminate\Support\Facades\Auth;



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
        // Ensure the user is authenticated
        $user = Auth::user();

        // If the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to proceed.');
        }

        // Retrieve booking data from session
        $booking = session('booking');

        // Check if session has booking details
        if (!$booking) {
            return redirect()->route('busses')->with('error', 'No booking found. Please select a bus first.');
        }

        // Get points information
        $pointsRequired = 10; // Number of points required for the discount
        $userPoints = $user->points;

        // Check if user is eligible for discount
        $canUsePoints = $userPoints >= $pointsRequired;

        // Pass data to the payment view
        return view('payment', compact('booking', 'userPoints', 'pointsRequired', 'canUsePoints'));
    }

    
    public function processPayment(Request $request)
    {
        $bookingData = session('booking');

        // Ensure that the user is logged in
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to proceed.');
        }

        // Retrieve the festival and bus route
        $festival = Festival::find($bookingData['festival_id']);
        if (!$festival) {
            return redirect()->route('busses')->with('error', 'Festival not found. Please start again.');
        }

        if (!$bookingData) {
            return redirect()->route('busses')->with('error', 'No booking found. Please start again.');
        }

        $busRoute = BusRoute::findOrFail($bookingData['bus_route_id']);
        $totalPrice = $busRoute->price * $bookingData['seats'];

        // Check if user is eligible for discount
        $userPoints = $user->points;
        $pointsRequired = 10; // Number of points required for the discount
        $discount = 0;

        // Check if the user selected to use points
        if ($request->has('use_points') && $userPoints >= $pointsRequired) {
            $discount = $totalPrice * 0.30; // 30% discount
            $totalPrice -= $discount;

            // Deduct points from the user
            $user->points -= $pointsRequired; // Deduct 10 points
            $user->save();

        }

        // Create the booking
        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->festival_id = $bookingData['festival_id'];
        $booking->bus_route_id = $bookingData['bus_route_id'];
        $booking->number_of_seats = $bookingData['seats'];
        $booking->booking_reference = strtoupper(bin2hex(random_bytes(5)));
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';
        $booking->total_price = $totalPrice;
        $booking->save();

        // Add 1 point for booking
        $user->points += 1;
        $user->save();
        
        // Clear the session booking data
        session()->forget('booking');
        // Redirect to the confirmation page with discount applied
        return redirect()->route('confirmation', ['booking' => $booking->id, 'discount' => $discount]);
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

    public function confirmation(Booking $booking, Request $request)
    {
        $booking->load('festival'); 

        $discount = $request->query('discount', 0);
        return view('confirmation', compact('booking', 'discount'));
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
