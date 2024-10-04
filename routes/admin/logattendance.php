<?php

use App\Http\Controllers\Admin\LogAttendanceController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/log-attendance', [LogAttendanceController::class, 'index'])->name('logattendance.index');
    Route::get('/log-attendance/create/{id}', [LogAttendanceController::class, 'create'])->name('logattendance.create');
    Route::post('/log-attendance', [LogAttendanceController::class, 'store'])->name('logattendance.store');
    Route::get('/log-attendance/{logattendance}/edit', [LogAttendanceController::class, 'edit'])->name('logattendance.edit');
    Route::put('/log-attendance/{logattendance}', [LogAttendanceController::class, 'update'])->name('logattendance.update');
    Route::delete('/log-attendance/{logattendance}', [LogAttendanceController::class, 'destroy'])->name('logattendance.destroy');
    Route::post('/log-attendances-import', [LogAttendanceController::class, 'import'])->name('logattendance.import');
    Route::get('/log-attendance/listdate/{id}', [LogAttendanceController::class, 'listdate'])->name('logattendance.listdate');
    Route::get('/log-attendance/list/{classroom_id}/{date}', [LogAttendanceController::class, 'list'])->name('logattendance.list');
});

?>