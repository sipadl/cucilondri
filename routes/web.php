<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

Route::get('hash/{id}', function($id){
    $hash = Hash::make($id);
    return $hash;
});


Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show/{id}');
        Route::get('deaktif/{id}', [App\Http\Controllers\UserController::class, 'deaktif'])->name('deaktifs');
        Route::get('delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroys');
        Route::get('password', [App\Http\Controllers\UserController::class, 'password'])->name('passwords');
        Route::post('password', [App\Http\Controllers\UserController::class, 'ubahPassword'])->name('edit.passwords');
        Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logouts');
        Route::resource('', App\Http\Controllers\UserController::class);
        Route::prefix('stok')->group(function () {
            Route::resource('', App\Http\Controllers\StokController::class);
            Route::get('{id}', [App\Http\Controllers\StokController::class, 'show'])->name('stoks');
            Route::get('status/{id}', [App\Http\Controllers\StokController::class, 'edit'])->name('stok.edit');
            Route::post('update', [App\Http\Controllers\StokController::class, 'update'])->name('stoks.updated');
        });
        Route::prefix('mitra')->group(function () {
            Route::resource('', App\Http\Controllers\MitraController::class);
            Route::post('update', [App\Http\Controllers\MitraController::class, 'update'])->name('update.mitra');
        });
        Route::prefix('service')->group(function () {
            Route::resource('', App\Http\Controllers\ServiceController::class);
            Route::get('{id}', [App\Http\Controllers\ServiceController::class,'show']);
            Route::post('update', [App\Http\Controllers\ServiceController::class, 'update'])->name('service.update');
            Route::get('proses/{id}', [App\Http\Controllers\ServiceController::class, 'proses'])->name('proses');
            Route::get('status/{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('service.edit');
        });
        Route::prefix('suplier')->group(function () {
            Route::resource('', App\Http\Controllers\SuplierController::class);
            Route::get('{id}', [App\Http\Controllers\SuplierController::class, 'show'])->name('stoks');
            Route::get('status/{id}', [App\Http\Controllers\SuplierController::class, 'edit'])->name('suplier.edit');
        });
        Route::prefix('transaction')->group(function () {
            Route::resource('', App\Http\Controllers\TransactionController::class);
            Route::get('print/{id}',[App\Http\Controllers\TransactionController::class, 'print'])->name('print');
        });
        Route::get('laporan', [App\Http\Controllers\UserController::class, 'laporan']);
        Route::get('getData', [App\Http\Controllers\UserController::class, 'dataLaporan'])->name('getLaporn');
    });
});
