<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataadminController;
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
// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/register', function () {
//     return view('register');
// });
// Route::get('/forgot-password', function () {
//     return view('forgot-password');
// });

Route::get('/login', [AuthController::class, 'login'])->name('loginView');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('registerView');
Route::post('/register', [AuthController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,staff')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

        Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');
        Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');
        Route::get('/pajaksub', [PajakController::class, 'pajaksub'])->name('pajakSub');
        Route::get('/pajak/pajakDetail/{id_pajak}', [PajakController::class, 'show'])->name('pajak.Detail');
        Route::get('/pajakEdit/{pajak}', [PajakController::class, 'edit'])->name('pajakEdit');
        Route::put('/pajakUpdate/{id_pajak}', [PajakController::class, 'update'])->name('pajakUpdate');

        Route::middleware('role:admin')->delete('/pajakDelete/{id_pajak}', [PajakController::class, 'destroy'])->name('pajakDestroy');

        Route::get('/pph', [PphController::class, 'index'])->name('getpphsub');
        Route::get('/getpph', [PphController::class, 'getPph'])->name('getPph');
        Route::post('/pphstore', [PphController::class, 'store'])->name('pphStore');
        Route::get('/pphsub', [PphController::class, 'pphsub'])->name('pphSub');
        Route::get('/pphEdit/{pph}', [PphController::class, 'edit'])->name('pphEdit');
        Route::put('/pphUpdate/{id_pph}', [PphController::class, 'update'])->name('pphUpdate');

        Route::middleware('role:admin')->delete('/pphDelete/{pph}', [PphController::class, 'destroy'])->name('pphDestroy');

        Route::get('/pphunifikasi', [PphunifikasiController::class, 'index'])->name('getpphunifikasisub');
        Route::get('/getpphunifikasi', [PphunifikasiController::class, 'getPphunifikasi'])->name('getPphunifikasi');
        Route::post('/pphunifikasistore', [PphunifikasiController::class, 'store'])->name('pphunifikasiStore');
        Route::get('/pphunifikasisub', [PphunifikasiController::class, 'pphunifikasisub'])->name('pphunifikasiSub');
        Route::get('/pphunifikasiEdit/{pphunifikasi}', [PphunifikasiController::class, 'edit'])->name('pphunifikasiEdit');
        Route::put('/pphunifikasiUpdate/{id_pphuni}', [PphunifikasiController::class, 'update'])->name('pphunifikasiUpdate');

        Route::middleware('role:admin')->delete('/pphunifikasiDelete/{pphunifikasi}', [PphunifikasiController::class, 'destroy'])->name('pphunifikasiDestroy');

        Route::get('/pph21', [Pph21Controller::class, 'index'])->name('pph21');
        Route::post('/pph21store', [Pph21Controller::class, 'store'])->name('pph21Store');
        Route::get('/pph21sub', [Pph21Controller::class, 'pph21sub'])->name('pph21Sub');
        Route::delete('/pph21Delete/{ppph21}', [Pph21Controller::class, 'destroy'])->name('pph21Destroy');
        Route::get('/pph21Edit/{pph21}', [Pph21Controller::class, 'edit'])->name('pph21Edit');
        Route::put('/pph21Update/{id}', [Pph21Controller::class, 'update'])->name('pph21Update');
        Route::get('/getpph21sub', [Pph21Controller::class, 'getPph21Sub'])->name('getpph21sub');

        Route::get('/getDataadmin', [DataadminController::class, 'getDataadmin'])->name('getDataadmin');
        Route::get('/dataadmin', [DataadminController::class, 'index'])->name('dataadmin');
        Route::post('/dataadmin', [DataadminController::class, 'store'])->name('dataadminStore');
        Route::get('/dataadminDelete/{id}', [DataadminController::class, 'destroy']);
        Route::get('/dataadminEdit/{id}', [DataadminController::class, 'edit'])->name('dataadminEdit');
        Route::put('/dataadminUpdate/{id}', [DataadminController::class, 'update'])->name('dataadminUpdate');

        Route::get('/getpajaksub', [PajakController::class, 'getPajakSub'])->name('getpajaksub');
        Route::post('/pajakstore', [PajakController::class, 'store'])->name('pajakStore');

        Route::get('/jenissub', [JenisController::class, 'jenissub'])->name('jenisSub');

        Route::get('/statussub', [StatusController::class, 'statussub'])->name('statusSub');

        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/karyawansub', [KaryawanController::class, 'karyawansub'])->name('karyawanSub');
        Route::post('/karyawanstore', [KaryawanController::class, 'store'])->name('karyawanStore');
        Route::get('/getkaryawan', [Pph21Controller::class, 'getKaryawan'])->name('getKaryawan');
        Route::post('/addkaryawan', [Pph21Controller::class, 'addKaryawan'])->name('addKaryawan');
        Route::delete('/deletekaryawan/{id}', [Pph21Controller::class, 'deleteKaryawan'])->name('deleteKaryawan');
        Route::get('/getkaryawansub', [KaryawanController::class, 'getKaryawanSub'])->name('getkaryawansub');
        Route::get('/karyawanEdit/{karyawan}', [KaryawanController::class, 'edit'])->name('karyawanEdit');
        Route::put('/karyawanUpdate/{karyawan}', [KaryawanController::class, 'update'])->name('karyawanUpdate');
        Route::delete('/karyawanDelete/{id}', [KaryawanController::class, 'destroy'])->name('karyawanDestroy');
    });
});

//Route untuk semua import
Route::post('/pphunifikasi/import_excel', [PphunifikasiController::class, 'import_excel'])->name('pphunifikasi.import_excel');
Route::post('/pph/import_excel', [PphController::class, 'import_excel'])->name('pph.import_excel');
Route::post('/pph21/import_excel', [Pph21Controller::class, 'import_excel'])->name('pph21.import_excel');
Route::post('/pajak/import_excel', [PajakController::class, 'import_excel'])->name('pajak.import_excel');
