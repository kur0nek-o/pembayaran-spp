<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\HistoryController;

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

/* ------------- Auth Route ------------- */
Route::get('/', function () {
    return view('index');
})->name('login')->middleware('guest');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('guest');
Route::post('/', [LoginController::class, '_validateRequest'])->middleware('guest');

/* ---------------- Application Route ---------------- */
Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title'     => 'Dashboard',
        'active'    => 'dashboard'
    ]);
})->middleware('auth');

Route::resource('/petugas', PetugasController::class)->middleware('auth');
Route::post('/loadPetugas', [PetugasController::class, '_load'])->middleware('auth');

Route::resource('/kelas', KelasController::class)->middleware('auth')->middleware('auth');
Route::post('/loadKelas', [KelasController::class, '_load'])->middleware('auth');
Route::get('/getKelasList', [KelasController::class, '_getItems'])->middleware('auth');

Route::resource('/spp', SppController::class)->middleware('auth')->middleware('auth');
Route::post('/loadSpp', [SppController::class, '_load'])->middleware('auth');
Route::get('/getSppList', [SppController::class, '_getItems'])->middleware('auth');

Route::resource('/siswa', SiswaController::class)->middleware('auth');
Route::post('/loadSiswa', [SiswaController::class, '_load'])->middleware('auth');

Route::get('/pembayaran', [PembayaranController::class, 'index'])->middleware('auth');
Route::post('/loadPembayaran', [PembayaranController::class, '_load'])->middleware('auth');
Route::get('/transaksi-pembayaran/{siswa}', [PembayaranController::class, 'create'])->middleware('auth');
Route::post('/transaksi-pembayaran', [PembayaranController::class, 'store'])->middleware('auth');

Route::get('/cetak-kwitansi/{pembayaran:id_pembayaran}', [HistoryController::class, 'cetakKwitansi'])->middleware('auth');
Route::get('/preview-kwitansi/{pembayaran:id_pembayaran}', [HistoryController::class, 'previewKwitansi'])->middleware('auth');

Route::get('/history', [HistoryController::class, 'index'])->middleware('auth');
