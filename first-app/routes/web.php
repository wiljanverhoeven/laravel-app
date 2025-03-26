<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusRouteController;
use app\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
