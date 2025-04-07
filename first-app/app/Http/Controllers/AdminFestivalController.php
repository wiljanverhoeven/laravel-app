<?php
namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminFestivalController extends Controller
{
    // Method for creating a new Festival
    public function create()
    {
        return view('admin.festival.createFestival');
    }

    // Method for editing an existing Festival
    public function edit(Festival $festival)
    {
        return view('admin.festival.editFestival', compact('festival'));
    }

    // Method for storing a new Festival
    public function store(Request $request)
    {
        try {
            // Convert "start_date" and "end_date" to "Y-m-d\TH:i" format if needed
            if ($request->has('start_date') && !str_contains($request->start_date, 'T')) {
                $request->merge([
                    'start_date' => date('Y-m-d\TH:i', strtotime($request->start_date))
                ]);
            }
            
            if ($request->has('end_date') && !str_contains($request->end_date, 'T')) {
                $request->merge([
                    'end_date' => date('Y-m-d\TH:i', strtotime($request->end_date))
                ]);
            }

            // Validate incoming data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date_format:Y-m-d\TH:i',
                'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
                'description' => 'nullable|string',
            ]);

            // Create a new festival
            Festival::create($validated);
            
            // Log the success
            Log::info('Festival created successfully:', $validated);

            return redirect()->route('admin.dashboard')->with('success', 'Festival created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating festival: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error creating festival: ' . $e->getMessage());
        }
    }

    // updating an existing Festival
    public function update(Request $request, Festival $festival)
    {
        try {
            // Convert date time format if needed
            if ($request->has('start_date') && !str_contains($request->start_date, 'T')) {
                $request->merge([
                    'start_date' => date('Y-m-d\TH:i', strtotime($request->start_date))
                ]);
            }
            
            if ($request->has('end_date') && !str_contains($request->end_date, 'T')) {
                $request->merge([
                    'end_date' => date('Y-m-d\TH:i', strtotime($request->end_date))
                ]);
            }

            // Validate incoming data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date_format:Y-m-d\TH:i',
                'end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_date',
                'description' => 'nullable|string',
            ]);

            // Update the festival
            $festival->update($validated);
            
            // Log the success
            Log::info('Festival updated successfully:', $validated);

            return redirect()->route('admin.dashboard')->with('success', 'Festival updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating festival: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error updating festival: ' . $e->getMessage());
        }
    }

    public function destroy(Festival $festival)
    {
        try {
            // Delete the festival
            $festival->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Festival deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting festival: ' . $e->getMessage());
            return back()->with('error', 'Error deleting festival: ' . $e->getMessage());
        }
    }
}
