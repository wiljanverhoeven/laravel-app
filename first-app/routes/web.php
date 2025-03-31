<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusRouteController;
use app\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;




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

Route::post('/busRoute/store', [BusRouteController::class, 'store'])->name('Bus');

Route::get('/payment/{booking}', [PaymentController::class, 'confirm'])->name('payment.confirm');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/payment', [BookingController::class, 'payment'])->name('payment');

Route::post('/process-payment', [BookingController::class, 'processPayment'])->name('process.payment');

Route::get('festivals', [FestivalController::class, 'index']);
 
Route::get('busses', [BusRouteController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
