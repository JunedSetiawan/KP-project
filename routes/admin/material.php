<?php

use App\Http\Controllers\Admin\MaterialController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/layanan-klasikal', [MaterialController::class, 'klasikal'])->name('material.klasikal');
    Route::get('/layanan-klasikal/kelas7', [MaterialController::class, 'kelas7'])->name('material.kelas7');
    Route::get('/layanan-klasikal/kelas8', [MaterialController::class, 'kelas8'])->name('material.kelas8');
    Route::get('/layanan-klasikal/kelas9', [MaterialController::class, 'kelas9'])->name('material.kelas9');
    Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/material/create', [MaterialController::class, 'create'])->name('material.create');
    Route::get('/material/{id}', [MaterialController::class, 'show'])->name('material.show');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{material}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{material}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('/material/{material}', [MaterialController::class, 'destroy'])->name('material.destroy');
    Route::post('/materials-import', [MaterialController::class, 'import'])->name('material.import');
});

?>