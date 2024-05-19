<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;





Route::middleware('auth')->group(function () {
    // Frontend Routes:
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/topRating',[HomeController::class,'topRating'])->name('topRating');
    Route::get('/suggested',[HomeController::class,'suggested'])->name('suggested');
    Route::get('/favorite',[HomeController::class,'favorite'])->name('favorite');



    Route::get('/run', [DataController::class, 'edit']);
    Route::resource('/rating', RatingController::class);

});













Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
