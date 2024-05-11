<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Pph21Controller;
use App\Http\Controllers\PphController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PphunifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');
Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');
Route::get('/pajaksub', [PajakController::class, 'pajaksub'])->name('pajakSub');
Route::get('/pajak/pajakDetail/{id_pajak}', [PajakController::class, 'show'])->name('pajak.Detail');
Route::get('/pajakEdit/{pajak}', [PajakController::class, 'edit'])->name('pajakEdit');
Route::put('/pajakUpdate/{id_pajak}', [PajakController::class, 'update'])->name('pajakUpdate');
Route::delete('/pajakDelete/{id_pajak}', [PajakController::class, 'destroy'])->name('pajakDestroy');

Route::get('/pph', [PphController::class, 'index'])->name('getpphsub');
Route::get('/getpph', [PphController::class, 'getPph'])->name('getPph');
Route::post('/pphstore', [PphController::class, 'store'])->name('pphStore');
Route::get('/pphsub', [PphController::class, 'pphsub'])->name('pphSub');
Route::get('/pphEdit/{pph}', [PphController::class, 'edit'])->name('pphEdit');
Route::put('/pphUpdate/{id_pph}', [PphController::class, 'update'])->name('pphUpdate');
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
Route::put('/pph21Update/{id_pph21}', [Pph21Controller::class, 'update'])->name('pph21Update');
Route::get('/getpph21sub', [Pph21Controller::class, 'getPph21Sub'])->name('getpph21sub');

Route::get('/getpajaksub', [PajakController::class, 'getPajakSub'])->name('getpajaksub');
Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');

Route::get('/jenissub', [JenisController::class, 'jenissub'])->name('jenisSub');

Route::get('/statussub', [StatusController::class, 'statussub'])->name('statusSub');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
