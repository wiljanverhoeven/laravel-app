<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBusRouteController;
use App\Http\Controllers\AdminFestivalController;
use App\Models\Festival;

// Route for bus route creation
Route::get('/busroute', [BusRouteController::class, 'create'])->name('busroute.create');

// Booking routes
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); 
Route::get('/payment', [BookingController::class, 'payment'])->name('payment'); 
Route::post('/process-payment', [BookingController::class, 'processPayment'])->name('process.payment'); 
Route::get('/confirmation', [BookingController::class, 'confirmation'])->name('confirmation'); 
Route::get('/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('confirmation');

// Payment confirmation route
Route::get('/payment/{booking}', [PaymentController::class, 'confirm'])->name('payment.confirm');

// Home page
Route::get('/', function () {
    return view('home', [
        'festivals' => Festival::all()
    ]);
})->name('home');

//festival list
Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals'); // View all festivals

// account routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin routes
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Admin Festival routes
Route::get('/festivals/create', [AdminFestivalController::class, 'create'])->name('admin.festivals.create');
Route::post('/festivals', [AdminFestivalController::class, 'store'])->name('admin.festivals.store');
Route::get('/festivals/{festival}/edit', [AdminFestivalController::class, 'edit'])->name('admin.festivals.edit');
Route::put('/festivals/{festival}', [AdminFestivalController::class, 'update'])->name('admin.festivals.update');
Route::delete('/admin/festivals/{festival}', [AdminFestivalController::class, 'destroy'])->name('admin.festivals.destroy');

// Admin Bus Route routes
Route::get('/busroutes/create', [AdminBusRouteController::class, 'create'])->name('admin.busroutes.create');
Route::post('/busroutes', [AdminBusRouteController::class, 'store'])->name('admin.busroutes.store');
Route::get('/busroutes/{busRoute}/edit', [AdminBusRouteController::class, 'edit'])->name('admin.busroutes.edit');
Route::put('/busroutes/{busRoute}', [AdminBusRouteController::class, 'update'])->name('admin.busroutes.update');
Route::delete('/admin/busroutes/{busRoute}', [AdminBusRouteController::class, 'destroy'])->name('admin.busroutes.destroy');

require __DIR__.'/auth.php';
