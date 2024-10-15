<?php

use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\ClassesController;
use Illuminate\Support\Facades\Route;

// create route for users
Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/achievement', [AchievementController::class, 'index'])->name('achievement.index');
    Route::get('/achievement/create', [AchievementController::class, 'create'])->name('achievement.create');
    Route::post('/achievement', [AchievementController::class, 'store'])->name('achievement.store');
    Route::get('/achievement/{achievement}/edit', [AchievementController::class, 'edit'])->name('achievement.edit');
    Route::put('/achievement/{achievement}', [AchievementController::class, 'update'])->name('achievement.update');
    Route::delete('/achievement/{achievement}', [AchievementController::class, 'destroy'])->name('achievement.destroy');
});

?>