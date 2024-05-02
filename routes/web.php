<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StatusController;
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
Route::get('/jenis', [JenisController::class, 'index'])->name('jenis');
Route::post('/jenisstore', [JenisController::class, 'store'])->name('jenisStore');
Route::get('/jenissub', [JenisController::class, 'jenissub'])->name('jenisSub');
Route::get('/jenisEdit/{jenis}', [JenisController::class, 'edit'])->name('jenisEdit');
Route::put('/jenisUpdate/{jenis}', [JenisController::class, 'update'])->name('jenisUpdate');
Route::delete('/jenisDelete/{jenis}', [JenisController::class, 'destroy'])->name('jenisDestroy');
Route::get('/pphunifikasi', [PphunifikasiController::class, 'index'])->name('pphunifikasi');
Route::post('/pphunifikasistore', [PphunifikasiController::class, 'store'])->name('pphunifikasiStore');
Route::get('/pphunifikasisub', [PphunifikasiController::class, 'pphunifikasisub'])->name('pphunifikasiSub');
Route::get('/pphunifikasiEdit/{pphunifikasi}', [PphunifikasiController::class, 'edit'])->name('pphunifikasiEdit');
Route::put('/pphunifikasiUpdate/{pphunifikasi}', [PphunifikasiController::class, 'update'])->name('pphunifikasiUpdate');
Route::delete('/pphunifikasiDelete/{pphunifikasi}', [PphunifikasiController::class, 'destroy'])->name('pphunifikasiDestroy');
