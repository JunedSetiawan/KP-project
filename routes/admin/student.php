<?php

use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

// create route for students
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{id}/detail', [StudentController::class, 'show'])->name('student.detail');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::post('/students-import', [StudentController::class, 'import'])->name('student.import');

    Route::get('/student/graduate', [StudentController::class, 'graduate'])->name('student.graduate');
});

?>