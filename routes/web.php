<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerCetak;
use App\Http\Controllers\ControllerChart;
use App\Http\Controllers\ControllerKaryawan;
use App\Http\Controllers\ControllerPendapatan;
use App\Http\Controllers\ControllerPengeluaran;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'CekKelompok:admin'])->group(function () {

    // karyawan
    Route::get('/karyawan', [ControllerKaryawan::class, 'index']);
    Route::get('/tbh_karyawan', [ControllerKaryawan::class, 'create'])->name('tbh_karyawan');
    Route::post('/postKaryawan', [ControllerKaryawan::class, 'store'])->name('postKaryawan');
    Route::get('/karyawan/edit/{id}', [ControllerKaryawan::class, 'show']);
    Route::post('/karyawan/upgrade/{id}', [ControllerKaryawan::class, 'upgradeKaryawan'])->name('upgradeKaryawan');
    Route::get('/delete_kar/{id}', [ControllerKaryawan::class, 'delete_kar']);

    //kelompok(user)
    Route::get('/kelompok', [ControllerKaryawan::class, 'index_K']);
    Route::get('/tbh_kelompok', [AuthController::class, 'tbh_kelompok']);
    Route::post('/postKelompok', [AuthController::class, 'store'])->name('regist');
    Route::get('/delete_Kl/{kode_kelompok}', [ControllerKaryawan::class, 'delete_K']);
    Route::get('/edit/{kode_kelompok}', [ControllerKaryawan::class, 'edit']);
    Route::post('/update/{kode_kelompok}', [ControllerKaryawan::class, 'update'])->name('update');

    // pegeluaran operasional
    Route::get('/operasional', [ControllerPengeluaran::class, 'operasional']);
    Route::get('/operasional/tambah', [ControllerPengeluaran::class, 'tbh_operasional']);
    Route::post('/operasional/tambah_operasional', [ControllerPengeluaran::class, 'postOperasional'])->name('postOperasional');
    Route::get('/operasional/edit/{id}', [ControllerPengeluaran::class, 'editOperasional']);
    Route::post('/operasional/upgrade/{id}', [ControllerPengeluaran::class, 'upgradeOperasional'])->name('upgradeOperasional');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ControllerPendapatan::class, 'index']);

    // pendapatan
    Route::get('/pendapatan', [ControllerPendapatan::class, 'tbl_pendapatan']);
    Route::get('/tbh_pendapatan', [ControllerPendapatan::class, 'create']);
    Route::post('/tbh_pendapatan/upload', [ControllerPendapatan::class, 'store'])->name('upload_pendapatan');
    Route::get('/laporan_m', [ControllerPendapatan::class, 'laporan_m']);

    Route::get('/pendapatan/edit/{id}', [ControllerPendapatan::class, 'edit'])->name('edit_pendapatan');
    Route::post('/pendapatan/update/{id}', [ControllerPendapatan::class, 'update'])->name('update_pendapatan');
    Route::get('/pendapatan/delete/{id}', [ControllerPendapatan::class, 'delete']);

    // cod
    Route::get('/cod', [ControllerPendapatan::class, 'cod']);
    Route::get('/cod/cod_sampai', [ControllerPendapatan::class, 'cod_sampai']);
    Route::get('/cod/cod_gagal', [ControllerPendapatan::class, 'cod_gagal']);

    // pengeluaran iklan
    Route::get('/pengeluaran', [ControllerPengeluaran::class, 'index']);
    Route::get('/tbh_pengeluaran', [ControllerPengeluaran::class, 'create']);
    Route::post('/tbh_pengeluaran/upload', [ControllerPengeluaran::class, 'store'])->name('upload_pengeluaran');
    Route::get('/laporan_k', [ControllerPengeluaran::class, 'laporan_k']);

    Route::get('/pengeluaran/edit/{id}', [ControllerPengeluaran::class, 'edit'])->name('edit_pengeluaran');
    Route::post('/pengeluaran/update/{id}', [ControllerPengeluaran::class, 'update'])->name('update_pengeluaran');
    Route::get('/pengeluaran/delete/{id}', [ControllerPengeluaran::class, 'delete']);

    // grafik dashboard
    Route::get('/chart', [ControllerChart::class, 'chartFull']);

    // edit profil
    Route::get('/edit/{kode_kelompok}', [ControllerKaryawan::class, 'edit']);
    Route::post('/update/{kode_kelompok}', [ControllerKaryawan::class, 'update'])->name('update');

    // ganti password
    Route::post('/user/password', [AuthController::class, 'ganti_pass'])->name('ganti.pass');

    // cetak pendapatan & pengeluaran
    Route::get('/dashboard/cetak', [ControllerCetak::class, 'dokumen']);

    Route::get('/pendapatan/cetak', [ControllerPendapatan::class, 'periode']);
    Route::get('/pengeluaran/cetak', [ControllerPengeluaran::class, 'periode_keluar'])->name('keluar');
});
