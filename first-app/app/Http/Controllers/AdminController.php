<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Festival;
use App\Models\BusRoute;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with(['bookings.festival', 'bookings.busRoute'])->get();
        $festivals = Festival::all();
        $busRoutes = BusRoute::with('festival')->get();

        return view('admin.adminDashboard', compact('users', 'festivals', 'busRoutes'));
    }
}