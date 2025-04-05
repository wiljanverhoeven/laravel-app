<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use app\Models\BusRoute;
use Illuminate\Database\Eloquent\Model;

class FestivalController extends Controller
{
    
   
    public function index()
    {
        $festival = Festival::with('busRoutes')->paginate(10); // Paginate results
        return view('festivals', compact('festival'));
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
