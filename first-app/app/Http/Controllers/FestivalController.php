<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;

class FestivalController extends Controller
{
    
   
    public function index()
    {
        $festival = Festival::all(); // Get all festivals from the database
        return view('festivals', compact('festival')); // Pass to view
        
    
    }

  
    public function create()
    {
      
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
