<?php

use App\Http\Controllers\FormController;
use App\modules\route\Route;

Route::get('/form/{errors}', [FormController::class, 'index'])->name('form.index')->middleware('not working yet');
Route::post('/form', [FormController::class, 'store'])->name('form.store')->middleware('not working yet');
Route::get('/show/{page}', [FormController::class, 'show'])->name('form.show')->middleware('not working yet');
