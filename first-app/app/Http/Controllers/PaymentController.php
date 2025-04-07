<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    // Display the payment page for a booking
    public function show(Booking $booking)
    {
        return view('payment', compact('booking'));
    }

    // Process the payment and update the booking status
    public function process(Request $request)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($request->booking_id);

        // Update the booking payment status and confirm the status
        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
        ]);

        // Redirect to the booking confirmation page
        return redirect()->route('confirmation', ['booking' => $booking->id]);
    }
}
