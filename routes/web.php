<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','checkRole:siswa']], function () {
    Route::get('/tugas/index',[App\Http\Controllers\tugasController::class, 'tawasul_index'])->name('tawasul.index');
    Route::get('/tugas/bersih',[App\Http\Controllers\tugasController::class, 'bersih_index'])->name('bersih.index');
    Route::post('/tugas/tawasul/add',[App\Http\Controllers\tugasController::class, 'tawasul_add'])->name('tawasul.add');
    Route::post('/tugas/bersih/add',[App\Http\Controllers\tugasController::class, 'bersih_add'])->name('bersih.add');

    Route::get('tugas/siswa/{id}',[App\Http\Controllers\tugasController::class, 'tugas_kumpul'])->name('siswa.tugas');

    Route::get('absen/siswa',[App\Http\Controllers\absenController::class, 'absen'])->name('absen.siswa');
});

Route::group(['middleware' => ['auth','checkRole:admin,guru']], function () {
    Route::get('absen/siswa',[App\Http\Controllers\absenController::class, 'absen'])->name('absen.siswa');
});

