<?php

use App\Models\Festival;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;

Route::get('/', function () {
    return view('home');
});

Route::get('booking', function () {
    return view('booking');
});

Route::get('payment', function () {
    return view('payment');
});

Route::get('festivals', function () {
    return view('festivals');
});

Route::get('festivals', [FestivalController::class, 'index']);