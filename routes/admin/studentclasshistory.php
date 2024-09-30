<?php

use App\Http\Controllers\Admin\StudentClassHistoryController;
use Illuminate\Support\Facades\Route;

// create route for students
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/studentclasshistory', [StudentClassHistoryController::class, 'index'])->name('studentclasshistory.index');
    Route::get('/studentclasshistory/create', [StudentClassHistoryController::class, 'create'])->name('studentclasshistory.create');
    Route::post('/studentclasshistory', [StudentClassHistoryController::class, 'store'])->name('studentclasshistory.store');
    Route::get('/studentclasshistory/{studentclasshistory}/edit', [StudentClassHistoryController::class, 'edit'])->name('studentclasshistory.edit');
    Route::put('/studentclasshistory/{studentclasshistory}', [StudentClassHistoryController::class, 'update'])->name('studentclasshistory.update');
    Route::delete('/studentclasshistory/{studentclasshistory}', [StudentClassHistoryController::class, 'destroy'])->name('studentclasshistory.destroy');
    Route::post('/studentclasshistorys-import', [StudentClassHistoryController::class, 'import'])->name('studentclasshistory.import');
});

?>