<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\JenisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');
Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');
Route::get('/pajaksub', [PajakController::class, 'pajaksub'])->name('pajakSub');
Route::get('/pajakEdit/{pajak}', [PajakController::class, 'edit'])->name('pajakEdit');
Route::put('/pajakUpdate/{pajak}', [PajakController::class, 'update'])->name('pajakUpdate');
Route::delete('/pajakDelete/{pajak}', [PajakController::class, 'destroy'])->name('pajakDestroy');
Route::get('/jenis', [JenisController::class, 'index'])->name('jenis');
Route::post('/jenisstore', [JenisController::class, 'store'])->name('jenisStore');
Route::get('/jenissub', [JenisController::class, 'jenissub'])->name('jenisSub');
