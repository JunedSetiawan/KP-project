<?php

use App\Http\Controllers\Admin\ClassesController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::get('/classes', [ClassesController::class, 'index'])->name('classes.index');
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/classes/create', [ClassesController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassesController::class, 'store'])->name('classes.store');
    Route::get('/classes/{classes}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{classes}', [ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{classes}', [ClassesController::class, 'destroy'])->name('classes.destroy');
    Route::post('/classess-import', [ClassesController::class, 'import'])->name('classes.import');
});

?>