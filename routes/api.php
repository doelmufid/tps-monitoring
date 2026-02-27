<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\Api\TPSController;

Route::post('/sensor', [SensorController::class, 'store']);
Route::post('/reset-tps', [ResetController::class, 'store']);
Route::get('/tps-config/{device_id}', [TPSController::class, 'config']);
