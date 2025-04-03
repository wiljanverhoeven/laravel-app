<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class BusRouteController extends Controller
{
    
    public function index()
    {
        
    }
    
   
    public function create()
    {
        $festivals = Festival::with('busRoutes')->get(); // Fetch festivals with bus routes
        return view('busses', compact('festivals')); // Pass to the Blade file
    }

   
    public function store(Request $request)
    {
        
    }

   
    public function show(string $id)
    {
       
    }

  
    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        
    }

   
    public function destroy(string $id)
    {
        
    }
}
