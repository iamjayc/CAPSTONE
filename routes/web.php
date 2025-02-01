<?php

use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.submit');
Route::get('/dashboard', function () {
    return view('manager');
})->name('dashboard');

Route::get('/logout', function () {
    return view('login');
})->name('logout');

//manage
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::get('/trips/{id}/edit', [TripController::class, 'edit'])->name('trips.edit');
Route::put('/trips/{id}', [TripController::class, 'update'])->name('trips.update');
Route::delete('/trips/{id}', [TripController::class, 'destroy'])->name('trips.destroy');