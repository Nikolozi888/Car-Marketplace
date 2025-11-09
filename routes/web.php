<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::resource('cars', CarController::class);

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/cars', [AdminController::class, 'carsIndex'])->name('cars.index');

});