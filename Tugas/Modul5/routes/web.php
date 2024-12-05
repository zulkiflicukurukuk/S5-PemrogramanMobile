<?php

use App\Http\Controllers\Api\CinemaController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Route to display the cinema list using CinemaController
Route::get('/cinema', [CinemaController::class, 'index']);  // This will call the index method in CinemaController

// Optional: This route will directly return the Tugas2 view without any data
// Route::view('/Tugas2', 'Tugas2');
