<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\Request;

class AdminFestivalController extends Controller
{
    public function create()
    {
        return view('admin.festival.createFestival');
    }

    public function edit(Festival $festival)
    {
        return view('admin.festival.editFestival', compact('festival'));
    }

    public function update(Request $request, Festival $festival)
    {
        $festival->update($request->all());
        return redirect()->route('admin.adminDashboard');
    }

}
