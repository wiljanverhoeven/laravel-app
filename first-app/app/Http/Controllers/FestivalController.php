<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\BusRoute; // Fixed namespace
use Illuminate\Database\Eloquent\Model;

class FestivalController extends Controller
{
    public function index()
    {
        // Paginate results and load associated bus routes
        $festivals = Festival::with('busRoutes')->paginate(10);

        return view('festivals', compact('festivals'));
    }
}
