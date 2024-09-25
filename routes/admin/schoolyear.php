<?php

use App\Http\Controllers\Admin\SchoolYearController;
use Illuminate\Support\Facades\Route;

// create route for students
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/schoolyear', [SchoolYearController::class, 'index'])->name('schoolyear.index');
    Route::get('/schoolyear/create', [SchoolYearController::class, 'create'])->name('schoolyear.create');
    Route::post('/schoolyear', [SchoolYearController::class, 'store'])->name('schoolyear.store');
    Route::get('/schoolyear/{schoolyear}/edit', [SchoolYearController::class, 'edit'])->name('schoolyear.edit');
    Route::put('/schoolyear/{schoolyear}', [SchoolYearController::class, 'update'])->name('schoolyear.update');
    Route::delete('/schoolyear/{schoolyear}', [SchoolYearController::class, 'destroy'])->name('schoolyear.destroy');
    Route::get('/schoolyear/{schoolyear}/switch', [SchoolYearController::class, 'switch'])->name('schoolyear.switch');


});

?>