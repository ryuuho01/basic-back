<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\Cors;

Route::apiResource('/user', UserController::class);
Route::apiResource('/area', AreaController::class);
Route::apiResource('/genre', GenreController::class);
Route::apiResource('/shop', ShopController::class);
Route::apiResource('/favorite', FavoriteController::class);
Route::apiResource('/reservation', ReservationController::class);

// Route::middleware(['cors'])->group(function () {

//   Route::apiResource('/user', UserController::class);
//   Route::apiResource('/area', AreaController::class);
//   Route::apiResource('/genre', GenreController::class);
//   Route::apiResource('/shop', ShopController::class);
//   Route::apiResource('/favorite', FavoriteController::class);
//   Route::apiResource('/reservation', ReservationController::class);

// });