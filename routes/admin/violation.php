<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\ViolationController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/violation', [ViolationController::class, 'index'])->name('violation.index');
    Route::get('/violation/create', [ViolationController::class, 'create'])->name('violation.create');
    Route::post('/violation', [ViolationController::class, 'store'])->name('violation.store');
    Route::get('/violation/{violation}/edit', [ViolationController::class, 'edit'])->name('violation.edit');
    Route::put('/violation/{violation}', [ViolationController::class, 'update'])->name('violation.update');
    Route::delete('/violation/{violation}', [ViolationController::class, 'destroy'])->name('violation.destroy');
});

?>