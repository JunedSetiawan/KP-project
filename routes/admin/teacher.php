<?php

use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

// create route for teachers
Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::post('/teachers-import', [TeacherController::class, 'import'])->name('teacher.import');
});

?>