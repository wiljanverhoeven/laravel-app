<?php

use Illuminate\Support\Facades\Route;

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