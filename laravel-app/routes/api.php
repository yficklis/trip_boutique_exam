<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/hotels', HotelController::class);
Route::get('/hotels/clientes-associated/{clientId}', [HotelController::class, 'search']);
Route::apiResource('/agencies', AgencyController::class);
Route::apiResource('/clients', ClientsController::class);