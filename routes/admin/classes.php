<?php

use App\Http\Controllers\Admin\ClassesController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/classroom', [ClassesController::class, 'index'])->name('classes.index');
    Route::get('/classroom/create', [ClassesController::class, 'create'])->name('classes.create');
    Route::post('/classroom', [ClassesController::class, 'store'])->name('classes.store');
    Route::get('/classroom/{classes}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
    Route::put('/classroom/{classes}', [ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/classroom/{classes}', [ClassesController::class, 'destroy'])->name('classes.destroy');
    Route::post('/classrooms-import', [ClassesController::class, 'import'])->name('classes.import');
});

?>