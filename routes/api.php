<?php

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

Route::post('show', [ShowController::class, 'store']);
Route::get('show', [ShowController::class, 'index']);

Route::post('viewer', [ViewerController::class, 'store']);
Route::get('viewer', [ViewerController::class, 'index']);