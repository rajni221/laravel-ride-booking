<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\DriverController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Passenger APIs
Route::post('/passenger/create', [PassengerController::class, 'createPassenger']);
Route::post('/ride/create',[PassengerController::class, 'createRide']);
Route::post('/ride/approve-driver', [PassengerController::class, 'approveDriver']);
Route::post('/ride/complete-passenger', [PassengerController::class, 'completeByPassenger']);

// Driver APIs
Route::post('/driver/create', [DriverController::class, 'createDriver']);
Route::post('/driver/update-location',[DriverController::class, 'updateLocation']);
Route::post('/driver/nearby-rides',[DriverController::class, 'nearbyRides']);
Route::post('/driver/request-ride',[DriverController::class, 'requestRide']);
Route::post('/driver/complete-ride',[DriverController::class, 'completeByDriver']);

