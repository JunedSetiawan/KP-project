<?php

use App\Http\Controllers\Admin\AttendanceController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create/{id}', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('/attendances-import', [AttendanceController::class, 'import'])->name('attendance.import');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/{classroom}', [AttendanceController::class, 'list'])->name('attendance.list');
    Route::post('/attendance/{student}/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
    Route::post('/attendance/submit-all/{classroom}', [AttendanceController::class, 'submitAll'])->name('attendance.submitAll');
    Route::get('/attendance/list/{id}', [AttendanceController::class, 'list'])->name('attendance.list');
});

?>