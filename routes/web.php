<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\JurnalController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('skripsi', SkripsiController::class);
Route::resource('jurnal', JurnalController::class);