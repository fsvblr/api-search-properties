<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('v1')
    ->middleware(['throttle:api'])
    ->group(function () {
        Route::apiResource('properties', \App\Http\Controllers\Api\V1\PropertyController::class);
    });
