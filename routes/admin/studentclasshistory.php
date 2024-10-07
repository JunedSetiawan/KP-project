<?php

use App\Http\Controllers\Admin\StudentClassHistoryController;
use Illuminate\Support\Facades\Route;

// create route for students
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/student-class-history', [StudentClassHistoryController::class, 'index'])->name('studentclasshistory.index');
    Route::get('/student-class-history/create', [StudentClassHistoryController::class, 'create'])->name('studentclasshistory.create');
    Route::post('/student-class-history', [StudentClassHistoryController::class, 'store'])->name('studentclasshistory.store');
    Route::get('/student-class-history/{studentclasshistory}/edit', [StudentClassHistoryController::class, 'edit'])->name('studentclasshistory.edit');
    Route::put('/student-class-history/{studentclasshistory}', [StudentClassHistoryController::class, 'update'])->name('studentclasshistory.update');
    Route::delete('/student-class-history/{studentclasshistory}', [StudentClassHistoryController::class, 'destroy'])->name('studentclasshistory.destroy');
    Route::post('/student-class-historys-import', [StudentClassHistoryController::class, 'import'])->name('studentclasshistory.import');
});

?>