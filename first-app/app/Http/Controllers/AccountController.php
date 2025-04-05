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

        return view('account', compact('user', 'bookings'));
    }
}
