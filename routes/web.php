<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaderisasiController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::group(
    [
        'middleware'    => ['role:admin-corporate'],
        'prefix'        => 'admin-corporate'
    ],
    function () {
        Route::resource('kaderisasi', App\Http\Controllers\KaderisasiController::class);
        Route::resource('soal', App\Http\Controllers\SoalController::class);
        Route::get('jurnal-publish', [JurnalController::class, 'jurnalPublish'])->name('jurnal-publish.index');
});

Route::group(
    [
        'middleware'    => ['role:admin-it'],
        'prefix'        => 'admin-it'
    ],
    function () {
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('karyawan', App\Http\Controllers\KaryawanController::class);
});

Route::group(
    [
        'middleware'    => ['role:manager'],
        'prefix'        => 'manager'
    ],
    function () {
        Route::resource('penugasan', App\Http\Controllers\PenugasanController::class);
        Route::get('penugasan-create/{id}', [PenugasanController::class, 'create'])->name('penugasan-create');
        Route::post('penugasan-store/{id}', [PenugasanController::class, 'store'])->name('penugasan-store');
        Route::get('verifikasi-jurnal', [JurnalController::class, 'verifikasiJurnal'])->name('verifikasi-jurnal.index');
        Route::get('verifikasi-jurnal-edit/{id}', [JurnalController::class, 'cekVerifikasi'])->name('verifikasi-jurnal-edit');
        Route::put('verifikasi-jurnal-update/{id}', [JurnalController::class, 'updateVerifikasi'])->name('verifikasi-jurnal-update');
});

Route::group(
    [
        'middleware'    => ['role:karyawan-junior'],
        'prefix'        => 'karyawan-junior'
    ],
    function () {
        Route::resource('jurnal', App\Http\Controllers\JurnalController::class);
        Route::get('jurnal-create/{id}', [JurnalController::class, 'create'])->name('jurnal-create');
        Route::post('jurnal-store/{id}', [JurnalController::class, 'store'])->name('jurnal-store');
        Route::put('jurnal-update/{id}', [JurnalController::class, 'update'])->name('jurnal-update');
        Route::get('nilai-senior/{id}', [JurnalController::class, 'nilaiSenior'])->name('nilai-senior');
        Route::post('nilai-senior-store/{id}', [JurnalController::class, 'nilaiSeniorStore'])->name('nilai-senior.store');
});

Route::group(
    [
        'middleware'    => ['role:karyawan-senior'],
        'prefix'        => 'karyawan-senior'
    ],
    function () {
        Route::resource('evaluasi', App\Http\Controllers\EvaluasiController::class);
        Route::get('evaluasi-edit/{id}', [EvaluasiController::class, 'edit'])->name('evaluasi-edit');
        Route::put('evaluasi-update/{id}', [EvaluasiController::class, 'update'])->name('evaluasi-update');
});

Route::group(
    [
        'middleware'    => ['role:karyawan-senior|karyawan-junior'],
        'prefix'        => 'karyawan'
    ],
    function () {
        Route::resource('penilaian', App\Http\Controllers\PenilaianController::class);
});