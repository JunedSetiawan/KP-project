<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\MaterialController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/material/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{material}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{material}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('/material/{material}', [MaterialController::class, 'destroy'])->name('material.destroy');
    Route::post('/materials-import', [MaterialController::class, 'import'])->name('material.import');
});

?>