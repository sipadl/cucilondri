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
    return view('authw.login');
})->name('auth.login');

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logouts');
        Route::resource('', App\Http\Controllers\UserController::class);
        Route::prefix('stok')->group(function () {
            Route::resource('', App\Http\Controllers\StokController::class);
            Route::get('{id}', [App\Http\Controllers\StokController::class, 'show'])->name('stoks');
            Route::post('update', [App\Http\Controllers\StokController::class, 'update'])->name('stoks.updated');
        });
        Route::prefix('mitra')->group(function () {
            Route::resource('', App\Http\Controllers\MitraController::class);
        });
        Route::prefix('service')->group(function () {
            Route::resource('', App\Http\Controllers\ServiceController::class);
            Route::get('{id}', [App\Http\Controllers\ServiceController::class,'show']);
            Route::post('update', [App\Http\Controllers\ServiceController::class, 'update'])->name('service.update');
            Route::get('proses/{id}', [App\Http\Controllers\ServiceController::class, 'proses'])->name('proses');
        });
        Route::prefix('suplier')->group(function () {
            Route::resource('', App\Http\Controllers\SuplierController::class);
            Route::get('{id}', [App\Http\Controllers\SuplierController::class, 'show'])->name('stoks');
        });
        Route::prefix('transaction')->group(function () {
            Route::resource('', App\Http\Controllers\TransactionController::class);
            Route::get('print/{id}',[App\Http\Controllers\TransactionController::class, 'print'])->name('print');
        });
        Route::get('laporan', [App\Http\Controllers\UserController::class, 'laporan']);
        Route::get('getData', [App\Http\Controllers\UserController::class, 'dataLaporan'])->name('getLaporn');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
