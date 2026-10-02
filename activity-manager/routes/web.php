<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::get('activities/trash', [ActivityController::class, 'trash'])->name('activities.trash');
Route::post('activities/{id}/restore', [ActivityController::class, 'restore'])->name('activities.restore');
Route::post('activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::post('activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');
Route::post('activities/{activity}/register', [ActivityController::class, 'register'])->name('activities.register');

Route::resource('activities', ActivityController::class);