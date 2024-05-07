<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Pph21Controller;
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
Route::get('/pajak/pajakDetail/{id_pajak}', [PajakController::class, 'show'])->name('pajak.Detail');
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

Route::get('/pph21', [Pph21Controller::class, 'index'])->name('pph21');
Route::post('/pph21store', [Pph21Controller::class, 'store'])->name('pph21Store');
Route::get('/pph21sub', [Pph21Controller::class, 'pph21sub'])->name('pph21Sub');
Route::delete('/pph21Delete/{ppph21}', [Pph21Controller::class, 'destroy'])->name('pph21Destroy');
Route::get('/pph21Edit/{pph21}', [Pph21Controller::class, 'edit'])->name('pph21Edit');
Route::put('/pph21iUpdate/{pph21}', [Pph21Controller::class, 'update'])->name('pph21Update');

Route::post('/pajakstore', [PajakController::class,'store'])->name('pajakStore');

Route::get('/jenissub', [JenisController::class, 'jenissub'])->name('jenisSub');

Route::get('/statussub', [StatusController::class, 'statussub'])->name('statusSub');
