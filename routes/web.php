<?php

use App\Http\Controllers\ApriorController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // Frontend Routes:
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/topRating',[HomeController::class,'topRating'])->name('topRating');
    Route::get('/suggested',[ApriorController::class,'suggested'])->name('suggested');
    Route::get('/favorite',[HomeController::class,'favorite'])->name('favorite');
    Route::get('/showMovie/{movie}',[HomeController::class,'showMovie'])->name('show');
    Route::resource('/rating', RatingController::class);
    Route::post('/search',[HomeController::class,'search'])->name('search');
    //Aprior Algorithm routes:
    Route::get('/aprior',[ApriorController::class,'index'])->name('aprior.index');
    Route::post('/apriori/process',[ApriorController::class,'process'])->name('apriori.process');



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
