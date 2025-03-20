<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;

class FestivalController extends Controller
{
    
   
    public function index()
    {
        $festivals = Festival::with('busRoutes')->get();
        return view('festivals', compact('festivals'));
        
    
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
