<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\InformationServiceController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::get('/informationservice/public', [InformationServiceController::class, 'public'])->name('informationservice.public');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/informationservice', [InformationServiceController::class, 'index'])->name('informationservice.index');
    Route::get('/informationservice/create', [InformationServiceController::class, 'create'])->name('informationservice.create');
    Route::post('/informationservice/store', [InformationServiceController::class, 'store'])->name('informationservice.store');
    Route::delete('/informationservice/{classes}', [InformationServiceController::class, 'destroy'])->name('informationservice.destroy');
});
