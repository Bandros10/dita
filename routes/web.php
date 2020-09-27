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
    Route::get('/tugas/Tadarus',[App\Http\Controllers\tugasController::class, 'tawasul_index'])->name('tawasul.index');
    Route::get('/tugas/bersih',[App\Http\Controllers\tugasController::class, 'bersih_index'])->name('bersih.index');
    Route::get('/tugas/literasi',[App\Http\Controllers\tugasController::class, 'literasi_index'])->name('literasi.index');
    Route::post('/tugas/Tadarus/add',[App\Http\Controllers\tugasController::class, 'tawasul_add'])->name('tawasul.add');
    Route::post('/tugas/bersih/add',[App\Http\Controllers\tugasController::class, 'bersih_add'])->name('bersih.add');
    Route::post('/tugas/literasi/add',[App\Http\Controllers\tugasController::class, 'literasi_add'])->name('literasi.add');

    Route::get('tugas/siswa/{id}',[App\Http\Controllers\tugasController::class, 'tugas_kumpul'])->name('siswa.tugas');
    Route::get('tugas/siswa/tadarus/edit/{id}',[App\Http\Controllers\tugasController::class, 'tugas_edit'])->name('siswa.edit');
    Route::get('tugas/siswa/literasi/edit/{id}',[App\Http\Controllers\tugasController::class, 'tugas_edit_literasi'])->name('siswa.edit.literasi');
    Route::get('tugas/siswa/bersih/edit/{id}',[App\Http\Controllers\tugasController::class, 'tugas_edit_bersih'])->name('siswa.edit.bersih');
    Route::post('tugas/siswa/update/{id}',[App\Http\Controllers\tugasController::class, 'tugas_update'])->name('siswa.update');
    Route::post('tugas/siswa/update/bersih/{id}',[App\Http\Controllers\tugasController::class, 'tugas_update_bersih'])->name('siswa.update.ber');
    Route::post('tugas/siswa/update/literasi/{id}',[App\Http\Controllers\tugasController::class, 'tugas_update_literasi'])->name('siswa.update.lit');

    Route::get('absen/siswa',[App\Http\Controllers\absenController::class, 'absen'])->name('absen.siswa');
});

Route::group(['middleware' => ['auth','checkRole:admin,guru']], function () {
    Route::get('absen/siswa',[App\Http\Controllers\absenController::class, 'absen'])->name('absen.siswa');
    Route::get('tugas/destroy/Tadarus/{id}',[App\Http\Controllers\absenController::class, 'tugas_destroy_taw'])->name('tugas.destroy_taw');
    Route::get('tugas/destroy/bersih/{id}',[App\Http\Controllers\absenController::class, 'tugas_destroy_ber'])->name('tugas.destroy_ber');
    Route::get('tugas/destroy/literasi/{id}',[App\Http\Controllers\absenController::class, 'tugas_destroy_lit'])->name('tugas.destroy_lit');
});

