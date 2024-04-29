<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');
Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');
Route::get('/pajaksub', [PajakController::class, 'pajaksub'])->name('pajakSub');
Route::get('/pajaksub/pajaked/{pajak}', [PajakController::class, 'edit']); 
Route::put('/pajaksub/pajaked/{pajak}/update', [PajakController::class, 'update']);
Route::delete('/pajaksub/hapus/{pajak}', [PajakController::class, 'destroy']);
