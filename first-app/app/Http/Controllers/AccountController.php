<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                // If user is not authenticated
                return redirect()->route('login')->with('error', 'Please log in to access your account.');
            }

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
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error retrieving account data: ' . $e->getMessage());

            // Return a user-friendly message
            return back()->with('error', 'There was an error retrieving your account information. Please try again later.');
        }
    }
}
