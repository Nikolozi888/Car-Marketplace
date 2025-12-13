<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarCenterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\GenerateImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::get('/email/send', [EmailsController::class, 'welcomeEmail']);

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::middleware('auth')->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::patch('/cars/{car}', [CarController::class, 'update']);
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});


Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    
    Route::resource('centers', CarCenterController::class)->names('centers');
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/cars', [AdminController::class, 'carsIndex'])->name('cars.index');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [GenerateImageController::class, '__invoke']);
Route::get('/pay', [PaymentController::class, 'pay']);
