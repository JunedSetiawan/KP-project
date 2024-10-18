<?php

use App\Http\Controllers\Admin\IndividualServiceController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => [ 'auth']], function () {
    Route::get('/individual-service', [IndividualServiceController::class, 'index'])->name('individual.service.index');


    Route::get('/individual-service/{classroom}/edit', [IndividualServiceController::class, 'edit'])->name('individual.service.edit');
    Route::post('/individual-service', [IndividualServiceController::class, 'store'])->name('individual.service.store');

    // create routes for comments
Route::post('/individual-service/{id}/comment', [IndividualServiceController::class, 'commentStore'])->name('individual.service.comment.store');
Route::delete('/individual-service/{individual-service:id}/comment/{comment:id}/delete', [IndividualServiceController::class, 'commentDestroy'])
    ->name('individual.service.comment.destroy');
Route::view('/individual-service/room', 'pages.individual.individual-service-chat')->name('individual.service.chat');
});
