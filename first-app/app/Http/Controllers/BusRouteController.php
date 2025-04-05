<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class BusRouteController extends Controller
{

   
    public function create(Request $request)
    {
        $festivalId = $request->query('festival_id'); // Retrieve festival ID from query param
        
        if (!$festivalId) {
            return redirect()->route('welcome')->with('error', 'Festival not selected.');
        }

        // Fetch the festival and associated bus routes
        $festival = Festival::findOrFail($festivalId);
        $busRoutes = $festival->busRoutes;

        return view('busses', compact('festival', 'busRoutes'));
    }

    

}
