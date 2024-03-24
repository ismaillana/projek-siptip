<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;

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
        'middleware'    => ['role:admin-it'],
        'prefix'        => 'admin-it'
    ],
    function () {
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('karyawan', App\Http\Controllers\KaryawanController::class);
});