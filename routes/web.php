<?php

use App\Http\Controllers\AbsensiKerjaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\JenisMemberController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengajuanBarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('cek-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', fn() => match (Auth::user()->role) {
        'Admin' => redirect()->Route('admin.dashboard'),
        'Kasir' => redirect()->Route('penjualan.index'),
        'SuperAdmin' => redirect()->Route('admin.dashboard'),
        'Owner' => redirect()->Route('owner.dashboard'),
        default => redirect()->Route('login'),
    });

    // Dashboard Routes
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/owner/dashboard', fn() => view('dashboard.owner'))->name('owner.dashboard');

    // Users
    Route::group([
        'prefix' => 'users',
        'middleware' => 'checkrole:SuperAdmin,Admin'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('edit/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('change-password/{id}', [UserController::class, 'changePassword'])->name('users.change-password');
        Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
        Route::patch('profile/{id}', [UserController::class, 'changeUsername'])->name('users.change-username');
    });

    // Karyawan
    Route::group([
        'prefix' => 'karyawan',
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::patch('edit/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('delete/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

    // Pemasok
    Route::group([
        'prefix' => 'pemasok',
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('/', [PemasokController::class, 'index'])->name('pemasok.index');
        Route::post('/', [PemasokController::class, 'store'])->name('pemasok.store');
        Route::put('edit/{id}', [PemasokController::class, 'update'])->name('pemasok.update');
        Route::delete('delete/{id}', [PemasokController::class, 'destroy'])->name('pemasok.destroy');
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
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner,Kasir'
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
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
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
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('/', [PembelianController::class, 'index'])->name('pembelian.index');
        Route::post('/', [PembelianController::class, 'store'])->name('pembelian.store');
        Route::get('detail/{id}', [PembelianController::class, 'detail'])->name('pembelian.detail');
    });

    // Penjualan
    Route::group([
        'prefix' => 'penjualan',
        'middleware' => 'checkrole:SuperAdmin,Admin,Kasir,Owner'
    ], function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::post('/', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('detail/{id}', [PenjualanController::class, 'detail'])->name('penjualan.detail');
        Route::get('count', [PenjualanController::class, 'count'])->name('penjualan.count');
        Route::get('/faktur/{id}', [PenjualanController::class, 'faktur'])->name('penjualan.faktur');
    });

    // Pembayaran
    Route::group([
        'prefix' => 'pembayaran',
        'middleware' => 'checkrole:SuperAdmin,Admin,Kasir'
    ], function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });

    // Laporan
    Route::group([
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('laporan-pembelian', [PembelianController::class, 'laporan'])->name('laporan-pembelian.index');
        Route::get('laporan-penjualan', [PenjualanController::class, 'laporan'])->name('laporan-penjualan.index');
        Route::get('laporan-stok', [BatchController::class, 'laporan'])->name('laporan-stok.index');
        Route::get('laporan-barang', [BarangController::class, 'laporan'])->name('laporan-barang.index');
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

    // Absensi Kerja
    Route::group([
        'prefix' => 'absensi-kerja',
        'middleware' => 'checkrole:SuperAdmin,Admin,Owner'
    ], function () {
        Route::get('/', [AbsensiKerjaController::class, 'index'])->name('absensi-kerja.index');
        Route::post('/', [AbsensiKerjaController::class, 'store'])->name('absensi-kerja.store');
        Route::patch('edit/{id}', [AbsensiKerjaController::class, 'update'])->name('absensi-kerja.update');
        Route::patch('edit-status/{id}', [AbsensiKerjaController::class, 'updateStatus'])->name('absensi-kerja.updateStatus');
        Route::patch('edit-selesai/{id}', [AbsensiKerjaController::class, 'updateSelesai'])->name('absensi-kerja.updateSelesai');
        Route::delete('delete/{id}', [AbsensiKerjaController::class, 'destroy'])->name('absensi-kerja.destroy');
        Route::get('exportExcel', [AbsensiKerjaController::class, 'exportExcel'])->name('absensi-kerja.exportExcel');
        Route::get('formatImport', [AbsensiKerjaController::class, 'formatImport'])->name('absensi-kerja.formatImport');
        Route::get('exportPDF', [AbsensiKerjaController::class, 'exportPDF'])->name('absensi-kerja.exportPDF');
        Route::post('import', [AbsensiKerjaController::class, 'import'])->name('absensi-kerja.import');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
