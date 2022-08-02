<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ViewerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('shows', [ShowController::class, 'store']);
Route::get('shows', [ShowController::class, 'index']);

Route::post('viewers', [ViewerController::class, 'store']);
Route::get('viewers', [ViewerController::class, 'index']);

Route::post('reserves', [ReservationController::class, 'store'])->middleware('reservation');