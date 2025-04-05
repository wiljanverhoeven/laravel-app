<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Models\Festival;

Route::get('/busroute', [BusRouteController::class, 'create'])->name('busroute.create');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); 

Route::get('/payment', [BookingController::class, 'payment'])->name('payment'); 

Route::post('/process-payment', [BookingController::class, 'processPayment'])->name('process.payment'); 

Route::get('/confirmation', [BookingController::class, 'confirmation'])->name('confirmation'); 

Route::get('/', function () {
    return view('home', [
        'festivals' => Festival::all()
    ]);
})->name('home');

Route::get('festivals', function () {return view('festivals');});

Route::get('/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('confirmation');

Route::get('/payment/{booking}', [PaymentController::class, 'confirm'])->name('payment.confirm');

Route::get('festivals', [FestivalController::class, 'index']);

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
