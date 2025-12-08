<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'user']);
Route::get('/users', [UserController::class, 'users']);
Route::apiResource('cars', CarController::class)->names('api.cars');