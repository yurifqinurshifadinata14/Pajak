<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');

