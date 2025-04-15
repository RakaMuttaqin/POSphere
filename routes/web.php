<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\JenisMemberController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengajuanBarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SatuanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('cek-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', fn() => match (Auth::user()->role) {
        'Admin' => redirect()->route('admin.dashboard'),
        'Kasir' => redirect()->route('penjualan.index'),
        'SuperAdmin' => redirect()->route('admin.dashboard'),
        'Owner' => redirect()->route('owner.dashboard'),
        default => redirect()->route('login'),
    });

    // Dashboard routes
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/owner/dashboard', fn() => view('dashboard.owner'))->name('owner.dashboard');

    // Users
    Route::group([
        'prefix' => 'users',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [AuthController::class, 'index'])->name('users.index');
        Route::post('/', [AuthController::class, 'store'])->name('users.store');
        Route::put('edit/{id}', [AuthController::class, 'update'])->name('users.update');
        Route::delete('delete/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
        Route::patch('change-password/{id}', [AuthController::class, 'changePassword'])->name('users.change-password');
        Route::get('profile', [AuthController::class, 'profile'])->name('users.profile');
        Route::patch('profile/{id}', [AuthController::class, 'changeUsername'])->name('users.change-username');
    });

    // Pemasok
    Route::group([
        'prefix' => 'pemasok',
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        route::get('/', [PemasokController::class, 'index'])->name('pemasok.index');
        route::post('/', [PemasokController::class, 'store'])->name('pemasok.store');
        route::put('edit/{id}', [PemasokController::class, 'update'])->name('pemasok.update');
        route::delete('delete/{id}', [PemasokController::class, 'destroy'])->name('pemasok.destroy');
    });

    // Member
    Route::group([
        'prefix' => 'member',
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner,Kasir'
    ], function () {
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::get('show', [MemberController::class, 'show'])->name('member.show');
        Route::post('/', [MemberController::class, 'store'])->name('member.store');
        Route::put('edit/{id}', [MemberController::class, 'update'])->name('member.update');
        Route::delete('delete/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
    });

    // Jenis Barang
    Route::group([
        'prefix' => 'jenis-barang',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
        Route::post('/', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
        Route::put('edit/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
        Route::delete('delete/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');
    });

    // Jenis Member
    Route::group([
        'prefix' => 'jenis-member',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [JenisMemberController::class, 'index'])->name('jenis-member.index');
        Route::post('/', [JenisMemberController::class, 'store'])->name('jenis-member.store');
        Route::put('edit/{id}', [JenisMemberController::class, 'update'])->name('jenis-member.update');
        Route::delete('delete/{id}', [JenisMemberController::class, 'destroy'])->name('jenis-member.destroy');
    });

    // Satuan
    Route::group([
        'prefix' => 'satuan',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [SatuanController::class, 'index'])->name('satuan.index');
        Route::post('/', [SatuanController::class, 'store'])->name('satuan.store');
        Route::put('edit/{id}', [SatuanController::class, 'update'])->name('satuan.update');
        Route::delete('delete/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
    });

    // Barang
    Route::group([
        'prefix' => 'barang',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [BarangController::class, 'index'])->name('barang.index');
        Route::post('/', [BarangController::class, 'store'])->name('barang.store');
        Route::get('list', [BarangController::class, 'list'])->name('barang.list');
        Route::put('edit/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Batch
    Route::group([
        'prefix' => 'batch',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [BatchController::class, 'index'])->name('batch.index');
        Route::post('/', [BatchController::class, 'store'])->name('batch.store');
        Route::get('list', [BatchController::class, 'list'])->name('batch.list');
        Route::put('edit/{id}', [BatchController::class, 'update'])->name('batch.update');
        Route::delete('delete/{id}', [BatchController::class, 'destroy'])->name('batch.destroy');
    });

    // Pembelian
    Route::group([
        'prefix' => 'pembelian',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        route::get('/', [PembelianController::class, 'index'])->name('pembelian.index');
        route::post('/', [PembelianController::class, 'store'])->name('pembelian.store');
        route::get('detail/{id}', [PembelianController::class, 'detail'])->name('pembelian.detail');
    });

    // Penjualan
    Route::group([
        'prefix' => 'penjualan',
        'middleware' => 'checkrole:SuperAdmin,Admin,Kasir'
    ], function () {
        route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
        route::post('/', [PenjualanController::class, 'store'])->name('penjualan.store');
        route::get('detail/{id}', [PenjualanController::class, 'detail'])->name('penjualan.detail');
        route::get('count', [PenjualanController::class, 'count'])->name('penjualan.count');
        route::get('/faktur/{id}', [PenjualanController::class, 'faktur'])->name('penjualan.faktur');
    });

    // Pembayaran
    Route::group([
        'prefix' => 'pembayaran',
        'middleware' => 'checkrole:SuperAdmin,Admin,Kasir'
    ], function () {
        route::get('/', [PembayaranController::class, 'index'])->name('pembayaran.index');
        route::post('/', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });

    // Laporan
    Route::group([
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('laporan-pembelian', [PembelianController::class, 'laporan'])->name('laporan-pembelian.index');
        Route::get('laporan-penjualan', [PenjualanController::class, 'laporan'])->name('laporan-penjualan.index');
        Route::get('laporan-stok', [BatchController::class, 'laporan'])->name('laporan-stok.index');
    });

    // Pengajuan Barang
    Route::group([
        'prefix' => 'pengajuan-barang',
        'middleware' => 'checkrole:SuperAdmin,Admin,Kasir'
    ], function () {
        Route::get('/', [PengajuanBarangController::class, 'index'])->name('pengajuan-barang.index');
        Route::post('/', [PengajuanBarangController::class, 'store'])->name('pengajuan-barang.store');
        Route::get('detail/{id}', [PengajuanBarangController::class, 'detail'])->name('pengajuan-barang.detail');
        Route::patch('edit/{id}', [PengajuanBarangController::class, 'update'])->name('pengajuan-barang.update');
        Route::patch('edit-status/{id}', [PengajuanBarangController::class, 'updateStatus'])->name('pengajuan-barang.updateStatus');
        Route::delete('delete/{id}', [PengajuanBarangController::class, 'destroy'])->name('pengajuan-barang.destroy');
        Route::get('export', [PengajuanBarangController::class, 'export'])->name('pengajuan-barang.export');
        Route::get('exportPDF', [PengajuanBarangController::class, 'generatePDF'])->name('pengajuan-barang.exportPDF');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
