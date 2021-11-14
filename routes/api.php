<?php

use App\Http\Controllers\API\ApiAuthorsController;
use Illuminate\Http\Request;
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

Route::fallback(function(){
    return response()->json([
        'message' => 'Route was not found'
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('authors' , ApiAuthorsController::class);
Route::apiResource('books' , \App\Http\Controllers\API\ApiBooksController::class);
Route::apiResource('publishers' , \App\Http\Controllers\API\ApiPublishersController::class);
