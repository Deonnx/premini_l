<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananLaundryController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function(){
    Route::get('/dasbroad', function () {
        return view('dasbroad');
    })->name('dasbroad');

 Route::post('/logout',[UsersController::class, 'logout'])->name('logout');

Route::get('/pelanggan',[PelangganController::class, 'index'])->name('pelanggan');
Route::post('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/destroy/{id}',[PelangganController::class, 'destroy'])->name('pelanggan.destroy');

Route::get('/pesanan_laundry',[PesananLaundryController::class, 'index'])->name('pesanan_laundry');
Route::post('/pesanan_laundry/create', [PesananLaundryController::class, 'create'])->name('pesanan_laundry.create');
Route::post('/pesanan_laundry/store', [PesananLaundryController::class, 'store'])->name('pesanan_laundry.store');
Route::post('/pesanan_laundry/update/{id}', [PesananLaundryController::class, 'update'])->name('pesanan_laundry.update');
Route::delete('/pesanan_laundry/destroy/{id}', [PesananLaundryController::class, 'destroy'])->name('pesanan_laundry.destroy');

Route::get('/pembayaran',[PembayaranController::class, 'index'])->name('pembayaran');
Route::post('/pembayaran/create', [PembayaranController::class,'create'])->name('pembayaran.create');
Route::post('/pembayaran/store',[PembayaranController::class, 'store'])->name('pembayaran.store');
Route::post('/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/destroy/{id}',[PembayaranController::class,'destroy'])->name('pembayaran.destroy');

});

Route::get('/', function () {
    return view('auth.login');
})->name('login.page');
Route::get('/register', function () {
    return view('auth/register');
})->name('register.page');


// Route::get('welcome', function (){
//     return view('welcome');
// })->name('welcome');


Route::post('/login',[UsersController::class,'login'])->name('login.submit');
// Route::post('/login',function() {
//     echo "hello";
// })->name('login.submit');
Route::post('/register-proses',[UsersController::class,'create'])->name('register.proses');


