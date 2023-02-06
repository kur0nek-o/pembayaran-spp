<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('index');
})->name('login')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/', [LoginController::class, '_validateRequest']);

Route::get('/dashboard', function() {
    return view('test');
})->middleware('auth');