<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusRouteController extends Controller
{
    public function create(Request $request)
    {
        try {
            $festivalId = $request->query('festival_id'); // Retrieve festival ID
            
            if (!$festivalId) {
                return redirect()->route('welcome')->with('error', 'Festival not selected.');
            }

            // Fetch the festival and associated bus routes
            $festival = Festival::find($festivalId);
            
            // If the festival is not found return an error message
            if (!$festival) {
                return redirect()->route('welcome')->with('error', 'Festival not found.');
            }

            // Get the bus routes associated with the festival
            $busRoutes = $festival->busRoutes;

            // If no bus routes are available for the festival, return an error message
            if ($busRoutes->isEmpty()) {
                return redirect()->route('welcome')->with('error', 'No bus routes available for this festival.');
            }

            return view('busses', compact('festival', 'busRoutes'));
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error in BusRouteController create method: ' . $e->getMessage());

            // Redirect with a general error message
            return redirect()->route('welcome')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
