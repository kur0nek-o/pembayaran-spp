<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KelasController;

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

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/', [LoginController::class, '_validateRequest']);

/* ---------------- Application Route ---------------- */
Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title'     => 'Dashboard',
        'active'    => 'dashboard'
    ]);
})->middleware('auth');

Route::resource('/petugas', PetugasController::class)->middleware('auth');
Route::post('/loadPetugas', [PetugasController::class, '_load'])->middleware('auth');

Route::resource('/kelas', KelasController::class)->middleware('auth');
Route::post('/loadKelas', [KelasController::class, '_load'])->middleware('auth');