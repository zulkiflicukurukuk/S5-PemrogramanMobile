<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/cinema', App\Http\Controllers\Api\CinemaController::class);
Route::apiResource('/actor', App\Http\Controllers\Api\ActorController::class);