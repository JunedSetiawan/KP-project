<?php

use App\Http\Controllers\Admin\SchoolYearController;
use Illuminate\Support\Facades\Route;

// create route for students
Route::group(['middleware' => ['can:manage-student','auth']], function () {
    Route::get('/school-year', [SchoolYearController::class, 'index'])->name('schoolyear.index');
    Route::get('/school-year/create', [SchoolYearController::class, 'create'])->name('schoolyear.create');
    Route::post('/school-year', [SchoolYearController::class, 'store'])->name('schoolyear.store');
    Route::get('/school-year/{schoolyear}/edit', [SchoolYearController::class, 'edit'])->name('schoolyear.edit');
    Route::put('/school-year/{schoolyear}', [SchoolYearController::class, 'update'])->name('schoolyear.update');
    Route::delete('/school-year/{schoolyear}', [SchoolYearController::class, 'destroy'])->name('schoolyear.destroy');
    Route::post('/school-year/{schoolyear}/switch', [SchoolYearController::class, 'switch'])->name('schoolyear.switch');


});

?>