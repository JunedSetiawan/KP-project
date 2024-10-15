<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\ImageUpload;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('home');
});
Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();


    Route::middleware('auth')->group(function () {
        Route::view('/tes','pdf.attendance');
        Route::post('/send-message', [MessageController::class, 'send']);

        Route::get('testing-table', [UserController::class, 'index'])->name('test.table');
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    });

    require __DIR__ . '/auth.php';
    require __DIR__ . '/admin/user.php';
    require __DIR__ . '/admin/student.php';
    require __DIR__ . '/admin/classes.php';
    require __DIR__ . '/admin/teacher.php';
    require __DIR__ . '/admin/schoolyear.php';
    require __DIR__ . '/admin/attendance.php';
    require __DIR__ . '/admin/studentclasshistory.php';
    require __DIR__ . '/admin/logattendance.php';
    require __DIR__ . '/admin/informationservice.php';
    require __DIR__ . '/admin/violation.php';
    require __DIR__ . '/admin/achievement.php';
});

Route::get('/post/{filename}/image', [ImageUpload::class, 'getImageFile'])->name('getImage');
