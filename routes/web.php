<?php

use App\Http\Controllers\SaldoController;
use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\DataLaundryController;
use App\Http\Controllers\data_pelangganController;
use App\Http\Controllers\DataPengeluaranController;
use App\Http\Controllers\JenisLaundryController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DataPenarikanController;
use App\Http\Controllers\TransaksiLaundryController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DahboardController;
use App\Models\Transaksi_laundry;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::middleware('auth')->group(function () {
    Route::get('/dasbroad', [DahboardController::class, 'index'])->name('dasbroad');

    Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
    
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/data_laporan',[DataLaporanController::class, 'index'])->name('data_laporan');
    // Route::post('/data_laporan/create',[DataLaporanController::class, 'create'])->name('data_laporan.create');
    Route::post('data_laporan/store',[DataLaporanController::class, 'store'])->name('data_laporan.store');

    Route::get('/jenis_laundry',[JenisLaundryController::class, 'index'])->name('jenis_laundry');
    Route::post('/jenis_laundry/create',[JenisLaundryController::class, 'create'])->name('jenis_laundry.create');
    Route::post('/jenis_laundry/store',[JenisLaundryController::class, 'store'])->name('jenis_laundry.store');
    Route::post('/jenis_laundry/update/{id}',[JenisLaundryController::class, 'update'])->name('jenis_laundry.update');
    Route::delete('/jenis_laundry/destroy/{id}',[JenisLaundryController::class, 'destroy'])->name('jenis_laundry.destroy');

    Route::get('/data_laporan',[DataLaporanController::class, 'index'])->name('data_laporan');
    Route::post('data_laporan/store',[DataLaporanController::class, 'store'])->name('data_laporan.store');
    Route::put('/pengeluaran/approve/{id}', [DataLaporanController::class, 'approve'])->name('pengeluaran.approve');
    Route::put('/data_pengeluaran/{id}/reject', [DataLaporanController::class, 'reject'])->name('pengeluaran.reject');

    Route::get('/Pelanggan',[PelangganController::class, 'index'])->name('pelanggan');
    Route::post('Pelanggan/store',[PelangganController::class, 'store'])->name('pelanggan.store');

    Route::get('/data_laundry',[DataLaundryController::class, 'index'])->name('data_laundry');
    Route::post('data_laundry/store',[DataLaundryController::class, 'store'])->name('data_laundry.store');

    Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo');
    Route::post('/saldo/update', [SaldoController::class, 'update'])->name('saldo.update');

});

    Route::get('/data_pelanggan', [data_pelangganController::class, 'index'])->name('data_pelanggan');
    Route::post('/data_pelanggan/create', [data_pelangganController::class, 'create'])->name('data_pelanggan.create');
    Route::post('/data_pelanggan/store', [data_pelangganController::class, 'store'])->name('data_pelanggan.store');
    Route::post('/data_pelanggan/update/{id}', [data_pelangganController::class, 'update'])->name('data_pelanggan.update');
    Route::delete('/data_pelanggan/destroy/{id}', [data_pelangganController::class, 'destroy'])->name('data_pelanggan.destroy');

    Route::get('/pengeluaran',[DataPengeluaranController::class, 'index'])->name('pengeluaran');
    Route::post('/pengeluaran/create',[DataPengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran/store',[DataPengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::post('/pengeluaran/approve/{id}', [DataPengeluaranController::class, 'approve'])->name('pengeluaran.approve');
    Route::post('/pengeluaran/reject/{id}', [DataPengeluaranController::class, 'reject'])->name('pengeluaran.reject');
    Route::post('/pengeluaran/update/{id}',[DataPengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/destroy/{id}',[DataPengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');


    Route::get('/transaksi_laundry',[TransaksiLaundryController::class, 'index'])->name('transaksi_laundry');
    Route::post('/transaksi_laundry/create',[TransaksiLaundryController::class, 'create'])->name('transaksi_laundry.create');
    Route::post('/transaksi_laundry/store',[TransaksiLaundryController::class, 'store'])->name('transaksi_laundry.store');
    Route::post('/transaksi_laundry/lunasi/{id}',[TransaksiLaundryController::class, 'lunasi'])->name('transaksi_laundry.lunasi');
    Route::post('/transaksi_laundry/update/{id}',[TransaksiLaundryController::class, 'update'])->name('transaksi_laundry.update');
    Route::delete('/transaksi_laundry/destroy/{id}',[TransaksiLaundryController::class, 'destroy'])->name('transaksi_laundry.destroy');
    Route::get('/autofill', [TransaksiLaundryController::class, 'autofill']);

    // Route::get('/data_penarikan', [DataPenarikanController::class, 'index'])->name('data_penarikan');
    // // Route::get('/data_penarikan/history', [DataPenarikanController::class, 'history'])->name('data_penarikan.history');
    // // Route::patch('/data_penarikan/approve/{id}', [DataPenarikanController::class, 'approve'])->name('data_penarikan.approve');
    // Route::post('/data_penarikan/store',[DataPenarikanController::class, 'store'])->name('data_penarikan.store');
    // Route::post('/data_penarikan/create',[DataPenarikanController::class, 'create'])->name('data_penarikan.create');
    // Route::post('/data_penarikan/update/{id}',[DataPenarikanController::class, 'update'])->name('data_penarikan.update');
    // Route::delete('/data_penarikan/destroy/{id}',[DataPenarikanController::class, 'destroy'])->name('data_penarikan.destroy');
    // // Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo');
    // // Route::post('/saldo/update', [SaldoController::class, 'update'])->name('saldo.update');
    




});
Route::get('/register', function () {
    return view('auth.register');
})->name('register.page');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');


Route::post('/login', [UsersController::class, 'login'])->name('login.submit');
Route::post('/register-proses', [UsersController::class, 'create'])->name('register.proses');
Route::get('/', function () {
    return view('auth.login');
})->name('login.page');
