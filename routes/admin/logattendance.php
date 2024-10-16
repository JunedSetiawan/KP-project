<?php

use App\Http\Controllers\Admin\LogAttendanceController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => ['can:manage-student','auth']], function () {
    Route::get('/logattendance', [LogAttendanceController::class, 'index'])->name('logattendance.index');
    Route::get('/logattendance/create/{id}', [LogAttendanceController::class, 'create'])->name('logattendance.create');
    Route::post('/logattendance', [LogAttendanceController::class, 'store'])->name('logattendance.store');
    Route::get('/logattendance/{logattendance}/edit', [LogAttendanceController::class, 'edit'])->name('logattendance.edit');
    Route::put('/logattendance/{logattendance}', [LogAttendanceController::class, 'update'])->name('logattendance.update');
    Route::delete('/logattendance/{logattendance}', [LogAttendanceController::class, 'destroy'])->name('logattendance.destroy');
    Route::post('/logattendances-import', [LogAttendanceController::class, 'import'])->name('logattendance.import');
    Route::get('/logattendance/listdate/{id}', [LogAttendanceController::class, 'listdate'])->name('logattendance.listdate');
    Route::get('/logattendance/list/{classroom_id}/{date}', [LogAttendanceController::class, 'list'])->name('logattendance.list');



});

Route::get('/attendance/pdf/{classrooms_id?}', [LogAttendanceController::class, 'exportPdf'])
    ->name('logattendance.exportPdf')
    ->middleware('auth')
    ->withoutMiddleware('splade') // Remove Splade middleware

?>
