<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\EventController;

// Menambahkan rute untuk EventController
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/add-events', [EventController::class, 'create'])->name('events.create');
Route::post('/add-data', [EventController::class, 'store'])->name('events.store');
Route::get('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::POST('/update/{id}', [EventController::class, 'update'])->name('events.update');

// Route::get('/', function () {
//     return view('welcome');
// });
