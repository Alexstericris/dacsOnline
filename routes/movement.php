<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\CharacterPositionApiController;


Route::post('/character/position/update', [CharacterPositionApiController::class, 'update']);
