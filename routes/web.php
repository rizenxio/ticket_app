<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\EventController;

// Menambahkan rute untuk EventController
Route::get('/', [EventController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });
