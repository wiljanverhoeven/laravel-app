<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all bookings for the user, eager load relations
        $bookings = $user->bookings()->with(['festival', 'busRoute'])->orderBy('created_at', 'desc')->get();

        // Count total bookings
        $totalBookings = $bookings->count();

        // Get the most recent booking date
        $lastBookingDate = $bookings->first()?->created_at;

        return view('account', [
            'user' => $user,
            'bookings' => $bookings,
            'total_bus_bookings' => $totalBookings,
            'last_bus_booking_date' => $lastBookingDate,
        ]);
    }
}
