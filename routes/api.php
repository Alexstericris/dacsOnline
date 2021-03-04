<?php

use App\Http\Controllers\ApiControllers\CharacterPositionApiController;
use App\Http\Controllers\ApiControllers\MapApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'map'], function () {
    Route::get('players', [MapApiController::class, 'getPlayers']);
});
Route::group(['prefix'=>'character'], function () {
    Route::group(['prefix'=>'position'], function () {
        Route::post('update', [CharacterPositionApiController::class, 'update']);
    });
});
