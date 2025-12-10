<?php

use App\Http\Controllers\Api\InfusionController;

Route::post('/infus/update', [InfusionController::class, 'update']);

Route::get('/infus/latest', [InfusionController::class, 'latest']);

Route::get('/infus/all-status', [InfusionController::class, 'allStatus']);