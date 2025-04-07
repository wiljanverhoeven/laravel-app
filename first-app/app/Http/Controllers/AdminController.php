<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Festival;
use App\Models\BusRoute;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        try {
            // Fetch users with their bookings, related festivals, and bus routes
            $users = User::with(['bookings.festival', 'bookings.busRoute'])->paginate(3);

            // Fetch all festivals
            $festivals = Festival::paginate(10);

            // Fetch all bus routes with related festival
            $busRoutes = BusRoute::paginate(10);

            // Return view with the data
            return view('admin.adminDashboard', compact('users', 'festivals', 'busRoutes'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error retrieving admin dashboard data: ' . $e->getMessage());

            // Return a user-friendly error message
            return back()->with('error', 'There was an error loading the admin dashboard. Please try again later.');
        }
    }
}
