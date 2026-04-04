<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Student\PeminjamanController as StudentPeminjamanController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [StudentPeminjamanController::class, 'index'])->name('student.peminjaman.index');
        Route::get('/katalog', [StudentPeminjamanController::class, 'katalog'])->name('student.peminjaman.katalog');
        Route::post('/store', [StudentPeminjamanController::class, 'store'])->name('student.peminjaman.store');
        Route::post('/{peminjaman}/kembalikan', [StudentPeminjamanController::class, 'kembalikan'])->name('student.peminjaman.kembalikan');
    });
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('kategori', KategoriController::class)->names([
        'index' => 'admin.kategori.index',
        'create' => 'admin.kategori.create',
        'store' => 'admin.kategori.store',
        'edit' => 'admin.kategori.edit',
        'update' => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

    Route::resource('buku', BukuController::class)->names([
        'index' => 'admin.buku.index',
        'create' => 'admin.buku.create',
        'store' => 'admin.buku.store',
        'edit' => 'admin.buku.edit',
        'update' => 'admin.buku.update',
        'destroy' => 'admin.buku.destroy',
    ]);

    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'anggota'
    ])->names([
        'index' => 'admin.anggota.index',
        'create' => 'admin.anggota.create',
        'store' => 'admin.anggota.store',
        'edit' => 'admin.anggota.edit',
        'update' => 'admin.anggota.update',
        'destroy' => 'admin.anggota.destroy',
    ]);

    Route::get('transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('transaksi', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::post('transaksi/{peminjaman}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('admin.transaksi.kembalikan');
    Route::delete('transaksi/{peminjaman}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
