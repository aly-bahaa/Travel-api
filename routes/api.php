<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|x
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
  
Route::get('/travels',[TravelController::class,'index']);
Route::get('/travels/{travel:slug}/tours',[TourController::class,'index']);

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::post('/travels',[TravelController::class,'store']);
    Route::post('/travels/{travel}/tours',[TourController::class,'store']);
});
Route::prefix('editor')->middleware(['auth:sanctum','role:editor'])->group(function () {
    Route::put('/travels/{travel}',[TravelController::class,'update']);
});

Route::post('/login',LoginController::class);
