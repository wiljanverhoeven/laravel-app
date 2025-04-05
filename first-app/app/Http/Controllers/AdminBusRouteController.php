<?php
namespace App\Http\Controllers;

use App\Models\BusRoute;
use Illuminate\Http\Request;
use App\Models\Festival;

class AdminBusRouteController extends Controller {

    // Method for creating a new BusRoute (returns the form view)
    public function create()
    {
        $festivals = Festival::all();  // Get all festivals
        return view('admin.busroute.createBusRoute', compact('festivals'));  // Use the 'addBusRoute' view
    }

    // Method for storing the new BusRoute
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'departure_location' => 'required|string|max:255',
            'departure_address' => 'required|string',
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'festival_id' => 'required|exists:festivals,id',
            'is_active' => 'nullable|boolean',
        ]);

        // Create a new bus route record
        BusRoute::create([
            'departure_location' => $request->departure_location,
            'departure_address' => $request->departure_address,
            'departure_date' => $request->departure_date,
            'arrival_date' => $request->arrival_date,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'festival_id' => $request->festival_id,
            'is_active' => $request->has('is_active') ? true : false,  // Handle checkbox for active status
        ]);

        // Redirect back to the bus route creation page with a success message
        return redirect()->route('admin.busroutes.create')->with('success', 'Bus route added successfully!');
    }

    // Method for editing an existing BusRoute
    public function edit(BusRoute $busRoute)
    {
        $festivals = Festival::all();  // Get all festivals
        return view('admin.busroute.editBusRoute', compact('busRoute', 'festivals'));  // Use the 'editBusRoute' view
    }

    // Method for updating an existing BusRoute
    public function update(Request $request, BusRoute $busRoute)
    {
        // Validate the incoming data
        $request->validate([
            'departure' => 'required|string|max:255',
            'arrival' => 'required|string|max:255',
            'festival_id' => 'required|exists:festivals,id',  // Ensure festival_id exists in the festivals table
        ]);

        // Update the busRoute with new data
        $busRoute->update($request->all());

        // Redirect after update
        return redirect()->route('admin.adminDashboard')->with('success', 'Bus route updated successfully!');
    }
}
