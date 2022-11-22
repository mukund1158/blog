<?php

use App\Http\Controllers\API\ApiController;
use GuzzleHttp\Middleware;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('listApiData/{id?}', [ApiController::class, 'listApiData']);
    Route::post('store', [ApiController::class, 'store']);
    Route::post('update', [ApiController::class, 'store']);
    Route::delete('delete/{id}', [ApiController::class, 'delete']);
});

Route::post('login', [ApiController::class, 'login']);
