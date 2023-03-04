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

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->middleware('auth');
    Route::post('/', '_validateRequest')->middleware('guest');
});

/* ---------------- Application Route ---------------- */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard.index', [
            'title'     => 'Dashboard',
            'active'    => 'dashboard'
        ]);
    });

    Route::resource('/petugas', PetugasController::class);
    Route::post('/loadPetugas', [PetugasController::class, '_load']);

    Route::resource('/kelas', KelasController::class);
    Route::controller(KelasController::class)->group(function() {
        Route::post('/loadKelas', '_load');
        Route::get('/getKelasList', '_getItems');
    });

    Route::resource('/spp', SppController::class);
    Route::controller(KelasController::class)->group(function() {
        Route::post('/loadSpp', [SppController::class, '_load']);
        Route::get('/getSppList', [SppController::class, '_getItems']);
    });

    Route::resource('/siswa', SiswaController::class);
    Route::post('/loadSiswa', [SiswaController::class, '_load']);

    Route::controller(PembayaranController::class)->group(function() {
        Route::get('/pembayaran',  'index');
        Route::post('/loadPembayaran',  '_load');
        Route::get('/transaksi-pembayaran/{siswa}',  'create');
        Route::post('/transaksi-pembayaran',  'store');
        Route::get('/edit-history/{pembayaran}',  'edit');
        Route::put('/edit-history/{pembayaran}',  'update');
    });

    Route::controller(HistoryController::class)->group(function() {
        Route::get('/history', [HistoryController::class, 'index']);
        Route::get('/loadHistory', [HistoryController::class, '_load']);
        Route::get('/cetak-kuitansi/{pembayaran}', [HistoryController::class, 'cetakKuitansi']);
        Route::get('/preview-kuitansi/{pembayaran}', [HistoryController::class, 'previewKuitansi']);
        Route::delete('/delete-history/{history}', [HistoryController::class, 'delete']);
    });
});
