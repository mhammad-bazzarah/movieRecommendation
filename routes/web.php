<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes:
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/run',[DataController::class,'edit']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
