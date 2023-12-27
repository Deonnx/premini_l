<?php

use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\DataPengeluaranController;
use App\Http\Controllers\JenisLaundryController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiLaundryController;
use App\Http\Controllers\UsersController;
use App\Models\Transaksi_laundry;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dasbroad', function () {
        return view('dasbroad');
    })->name('dasbroad');

    Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
    Route::post('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/pengeluaran',[DataPengeluaranController::class, 'index'])->name('pengeluaran');
    Route::post('/pengeluaran/create',[DataPengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran/store',[DataPengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::post('/pengeluaran/update/{id}',[DataPengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/destroy/{id}',[DataPengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    Route::get('/jenis_laundry',[JenisLaundryController::class, 'index'])->name('jenis_laundry');
    Route::post('/jenis_laundry/create',[JenisLaundryController::class, 'create'])->name('jenis_laundry.create');
    Route::post('/jenis_laundry/store',[JenisLaundryController::class, 'store'])->name('jenis_laundry.store');
    Route::post('/jenis_laundry/update/{id}',[JenisLaundryController::class, 'update'])->name('jenis_laundry.update');
    Route::delete('/jenis_laundry/destroy/{id}',[JenisLaundryController::class, 'destroy'])->name('jenis_laundry.destroy');

    Route::get('/transaksi_laundry',[TransaksiLaundryController::class, 'index'])->name('transaksi_laundry');
    Route::post('/transaksi_laundry/create',[TransaksiLaundryController::class, 'create'])->name('transaksi_laundry.create');
    Route::post('/transaksi_laundry/store',[TransaksiLaundryController::class, 'store'])->name('transaksi_laundry.store');
    Route::post('/transaksi_laundry/update/{id}',[TransaksiLaundryController::class, 'update'])->name('transaksi_laundry.update');
    Route::delete('/transaksi_laundry/destroy/{id}',[TransaksiLaundryController::class, 'destroy'])->name('transaksi_laundry.destroy');
    Route::get('/autofill', [TransaksiLaundryController::class, 'autofill']);

    Route::get('/data_laporan',[DataLaporanController::class, 'index'])->name('data_laporan');
    // Route::post('/data_laporan/create',[DataLaporanController::class, 'create'])->name('data_laporan.create');
    Route::post('data_laporan/store',[DataLaporanController::class, 'store'])->name('data_laporan.store');






});
Route::get('/register', function () {
    return view('auth.register');
})->name('register.page');

Route::post('/login', [UsersController::class, 'login'])->name('login.submit');
Route::post('/register-proses', [UsersController::class, 'create'])->name('register.proses');
Route::get('/', function () {
    return view('auth.login');
})->name('login.page');
