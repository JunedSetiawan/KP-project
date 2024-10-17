<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\DetailMaterialController;
use App\Http\Controllers\Admin\MaterialController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/detailmaterial/{material_id}', [DetailMaterialController::class, 'index'])->name('detailmaterial.index');
    Route::get('/detailmaterial/create/{material_id}', [DetailMaterialController::class, 'create'])->name('detailmaterial.create');
    Route::post('/detailmaterial', [DetailMaterialController::class, 'store'])->name('detailmaterial.store');
    Route::get('/detailmaterial/{material}/edit', [DetailMaterialController::class, 'edit'])->name('detailmaterial.edit');
    Route::put('/detailmaterial/{material}', [DetailMaterialController::class, 'update'])->name('detailmaterial.update');
    Route::delete('/detailmaterial/{detailMaterial}', [DetailMaterialController::class, 'destroy'])->name('detailmaterial.destroy');
});

?>