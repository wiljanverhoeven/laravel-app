<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusRouteController;

Route::get('/', function () {
    return view('home');
});

Route::get('busses', function () {
    return view('busses');
});

Route::get('payment', function () {
    return view('payment');
});

Route::get('festivals', function () {
    return view('festivals');
});

Route::get('festivals', [FestivalController::class, 'index']);

Route::get('busses', [BusRouteController::class, 'create']);

Route::post('BusRoute.store', [BusRouteController::class, 'store'])->name('Bus');