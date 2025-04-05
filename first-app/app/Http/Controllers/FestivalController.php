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


}
