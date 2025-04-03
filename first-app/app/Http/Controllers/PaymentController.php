<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        return view('payment', compact('booking'));
    }

    public function process(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
        ]);

        return redirect()->route('booking.confirmation', ['booking' => $booking->id]);
    }
    public function confirm(Booking $booking)
    {
        return view('payment', compact('booking'));
    }
}
