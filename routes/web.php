<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\UserLoginController;
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
use App\Http\Controllers\ExportController;
use App\Http\Controllers\User\BerandaUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\RedirectIfUserAuthenticated;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'store'])->name('register');

// User Routes
Route::get('/user/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserLoginController::class, 'login'])->name('user.login.post');
Route::post('/user/logout', [UserLoginController::class, 'logout'])->name('user.logout');

Route::middleware(['auth:user'])->group(function () {
    Route::get('/user/beranda', [BerandaUserController::class, 'index'])->name('user.beranda');
    Route::get('/user/profil', [UserController::class, 'index'])->name('user.profil');
});

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth:admin'])->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::get('/pajak', [PajakController::class, 'index'])->name('pajak');
    Route::get('/getpajaksub', [PajakController::class, 'getPajakSub'])->name('getpajaksub');
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

    Route::get('/pphunifikasi', [PphunifikasiController::class, 'index'])->name('getpphunifikasisub');
    Route::get('/getpphunifikasi', [PphunifikasiController::class, 'getPphunifikasi'])->name('getPphunifikasi');
    Route::post('/pphunifikasistore', [PphunifikasiController::class, 'store'])->name('pphunifikasiStore');
    Route::get('/pphunifikasisub', [PphunifikasiController::class, 'pphunifikasisub'])->name('pphunifikasiSub');
    Route::get('/pphunifikasiEdit/{pphunifikasi}', [PphunifikasiController::class, 'edit'])->name('pphunifikasiEdit');
    Route::put('/pphunifikasiUpdate/{id_pphuni}', [PphunifikasiController::class, 'update'])->name('pphunifikasiUpdate');

    Route::delete('/pphunifikasiDelete/{pphunifikasi}', [PphunifikasiController::class, 'destroy'])->name('pphunifikasiDestroy');

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
    Route::delete('/dataadminDelete/{id}', [DataAdminController::class, 'dataadminDelete'])->name('dataadminDelete');
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


//Route untuk semua import
Route::post('/pphunifikasi/import_excel', [PphunifikasiController::class, 'import_excel'])->name('pphunifikasi.import_excel');
Route::post('/pph/import_excel', [PphController::class, 'import_excel'])->name('pph.import_excel');
Route::post('/pph21/import_excel', [Pph21Controller::class, 'import_excel'])->name('pph21.import_excel');
Route::post('/pajak/import_excel', [PajakController::class, 'import_excel'])->name('pajak.import_excel');
Route::post('/karyawan/import_excel', [KaryawanController::class, 'import_excel'])->name('karyawan.import_excel');
Route::post('/dataadmin/import', [DataadminController::class, 'import'])->name('dataadmin.import');

//Export Excel & PDF
Route::get('/export-exceldataadmin', [DataadminController::class, 'export_excel_dataadmin'])->name('export.exceldataadmin');
Route::get('/export-excel/karyawan', [KaryawanController::class, 'export_excel_karyawan'])->name('export.excelkaryawan');
Route::get('/export-pdf-dataadmin', [ExportController::class, 'exportPDF_dataadmin'])->name('export.pdf');
Route::get('/export-excel/pphunifikasi', [PphunifikasiController::class, 'export_excel_pphuni'])->name('export.excel');
Route::get('/export-pdf-pphuni', [PphunifikasiController::class, 'exportPDF_pphuni'])->name('export.pdfuni');
Route::get('/export_excelpajak', [PajakController::class, 'export_excelpajak'])->name('export.excelpajak');
Route::get('/export-pdf-pajak', [PajakController::class, 'exportPDF_pajak'])->name('export.pajak');
Route::get('/export_excel/pph21', [Pph21Controller::class, 'export_excel_pph21'])->name('export.excelpph21');
Route::get('/export-pdf-pph21', [Pph21Controller::class, 'exportPDF_pph21'])->name('export.pph21');
Route::get('/export_excel/pph', [PphController::class, 'export_excel_pph'])->name('export.excelpph');
Route::get('/export-pdf-pph', [PphController::class, 'exportPDF_pph'])->name('export.pph');



