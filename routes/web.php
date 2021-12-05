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
Route::prefix('user')->group(function () {
    Route::resource('', App\Http\Controllers\UserController::class);
    Route::prefix('stok')->group(function () {
        Route::resource('', App\Http\Controllers\StokController::class);
        Route::get('{id}', [App\Http\Controllers\StokController::class, 'show'])->name('stoks');
        Route::post('update', [App\Http\Controllers\StokController::class, 'update'])->name('stoks.updated');

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
    });
    Route::get('laporan', [App\Http\Controllers\UserController::class, 'laporan']);
    Route::get('time', function(){
        return date('Y-m-d H:i:s', time());
    });
    Route::post('getData', [App\Http\Controllers\UserController::class, 'getLaporan'])->name('getLaporn');
});
