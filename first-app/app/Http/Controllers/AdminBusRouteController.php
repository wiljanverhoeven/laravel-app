<?php
namespace App\Http\Controllers;

use App\Models\BusRoute;
use Illuminate\Http\Request;
use App\Models\Festival;
use Illuminate\Support\Facades\Log;
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
        try {
            // Convert checkbox value before validation
            $request->merge([
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            if ($request->has('departure_date') && !str_contains($request->departure_date, 'T')) {
                // Convert "2025-04-07 10:14:00" to "2025-04-07T10:14"
                $request->merge([
                    'departure_date' => date('Y-m-d\TH:i', strtotime($request->departure_date))
                ]);
            }
            
            if ($request->has('arrival_date') && !str_contains($request->arrival_date, 'T')) {
                // Convert "2025-04-07 10:14:00" to "2025-04-07T10:14"
                $request->merge([
                    'arrival_date' => date('Y-m-d\TH:i', strtotime($request->arrival_date))
                ]);
            }

            // Validate incoming data
            $validated = $request->validate([
                'departure_location' => 'required|string|max:255',
                'departure_address' => 'required|string',
                'departure_date' => 'required|date_format:Y-m-d\TH:i',
                'arrival_date' => 'required|date_format:Y-m-d\TH:i',
                'capacity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'festival_id' => 'required|exists:festivals,id',
                'is_active' => 'boolean',
            ]);

        // Create a new bus route record
        BusRoute::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Bus route created successfully!');
    } catch (\Exception $e) {
        Log::error('Error creating bus route: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Error creating bus route: ' . $e->getMessage());
    }
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
        try {
            // Convert checkbox value
            $request->merge([
                'is_active' => $request->has('is_active') ? true : false,
            ]);
            
            // Convert date formats if needed
            if ($request->has('departure_date') && !str_contains($request->departure_date, 'T')) {
                // Convert "2025-04-07 10:14:00" to "2025-04-07T10:14"
                $request->merge([
                    'departure_date' => date('Y-m-d\TH:i', strtotime($request->departure_date))
                ]);
            }
            
            if ($request->has('arrival_date') && !str_contains($request->arrival_date, 'T')) {
                // Convert "2025-04-07 10:14:00" to "2025-04-07T10:14"
                $request->merge([
                    'arrival_date' => date('Y-m-d\TH:i', strtotime($request->arrival_date))
                ]);
            }
            
            Log::info('Modified request data with formatted dates:', $request->all());

            // Rest of your validation and update code...
            $validated = $request->validate([
                'departure_location' => 'required|string|max:255',
                'departure_address' => 'required|string',
                'departure_date' => 'required|date_format:Y-m-d\TH:i',
                'arrival_date' => 'required|date_format:Y-m-d\TH:i',
                'capacity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'festival_id' => 'required|exists:festivals,id',
                'is_active' => 'boolean',
            ]);
            
            $busRoute->update($validated);
            
            return redirect()->route('admin.dashboard')->with('success', 'Bus route updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating bus route: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error updating bus route: ' . $e->getMessage());
        }
    }

    public function destroy(BusRoute $busRoute)
    {
        try {
            // Delete the bus route
            $busRoute->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Bus route deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting bus route: ' . $e->getMessage());
            return back()->with('error', 'Error deleting bus route: ' . $e->getMessage());
        }
    }
}
