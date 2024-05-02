<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\PphController;
use App\Http\Controllers\PphunifikasiController;
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

Route::get('/pph', [PphController::class, 'index'])->name('pph');
Route::post('/pphstore', [PphController::class, 'store'])->name('pphStore');
Route::get('/pphsub', [PphController::class, 'pphsub'])->name('pphSub');
Route::get('/pphEdit/{pph}', [PphController::class, 'edit'])->name('pphEdit');
Route::put('/pphUpdate/{pph}', [PphController::class, 'update'])->name('pphUpdate');
Route::delete('/pphDelete/{pph}', [PphController::class, 'destroy'])->name('pphDestroy');

Route::get('/pphunifikasi', [PphunifikasiController::class, 'index'])->name('pphunifikasi');
Route::post('/pphunifikasistore', [PphunifikasiController::class, 'store'])->name('pphunifikasiStore');
Route::get('/pphunifikasisub', [PphunifikasiController::class, 'pphunifikasisub'])->name('pphunifikasiSub');
Route::get('/pphunifikasiEdit/{pphunifikasi}', [PphunifikasiController::class, 'edit'])->name('pphunifikasiEdit');
Route::put('/pphunifikasiUpdate/{pphunifikasi}', [PphunifikasiController::class, 'update'])->name('pphunifikasiUpdate');
Route::delete('/pphunifikasiDelete/{pphunifikasi}', [PphunifikasiController::class, 'destroy'])->name('pphunifikasiDestroy');

