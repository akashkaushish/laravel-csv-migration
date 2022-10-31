<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellersController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/load', [SellersController::class, 'uploadContent']);
Route::get('/sellers', [SellersController::class, 'index']);
Route::get('/sellers/{id}', [SellersController::class, 'show']);
Route::get('/sellers/{id}/contacts', [SellersController::class, 'contacts']);
Route::get('/sellers/{id}/sales', [SellersController::class, 'sales']); 
Route::get('/sales/{year}', [SellersController::class, 'salesperyear']);
