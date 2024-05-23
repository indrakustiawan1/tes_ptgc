<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BigramProbabilitasController;
use App\Http\Controllers\CorpusController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HadisController;
use App\Http\Controllers\KamusOrangController;
use App\Http\Controllers\KamusTempatController;
use App\Http\Controllers\KamusWaktuController;
use App\Http\Controllers\KataDasarController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StopwordController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(
    function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //user
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::post('user/user_list', [UserController::class, 'user_list'])->name('user.list');
        Route::post('user', [UserController::class, 'store']);
        Route::get('user/{user}/edit', [UserController::class, 'edit']);
        Route::delete('user/{user}', [UserController::class, 'destroy']);

        //produk
        Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::post('produk/produk_list', [ProdukController::class, 'produk_list'])->name('produk.list');
        Route::post('produk', [ProdukController::class, 'store']);
        Route::get('produk/{produk}/edit', [ProdukController::class, 'edit']);
        Route::delete('produk/{produk}', [ProdukController::class, 'destroy']);

        //transaksi
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        // Route::post('transaksi/transaksi_list', [TransaksiController::class, 'transaksi_list'])->name('transaksi.list');
        Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

        //voucher
        Route::get('voucher', [VoucherController::class, 'index'])->name('voucher.index');
        Route::post('/voucher/check', [VoucherController::class, 'checkVoucher'])->name('voucher.check');
        Route::post('/voucher/redeem', [VoucherController::class, 'redeemVoucher'])->name('voucher.redeem');

        //produk
        Route::get('riwayat_transaksi', [TransaksiController::class, 'index_riwayat_transaksi'])->name('riwayat_transaksi.index');
        Route::post('riwayat_transaksi/riwayat_transaksi_list', [TransaksiController::class, 'riwayat_transaksi_list'])->name('riwayat_transaksi.list');
    }
);
