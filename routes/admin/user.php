<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/users-import', [UserController::class, 'import'])->name('user.import');
});

?>