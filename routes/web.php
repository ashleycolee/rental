<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AlatMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('role:user')->name('home');

    Route::get('/peminjaman-saya', function () {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Akses hanya untuk user.');
        }
        return view('livewire.peminjaman-saya');
    })->name('peminjaman.user');

    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('create/{id?}', [PeminjamanController::class, 'create'])->name('create');
        Route::post('create', [PeminjamanController::class, 'store'])->name('store');
        Route::get('show/{peminjaman}', [PeminjamanController::class, 'show'])->name('show');
        Route::get('edit/{peminjaman}', [PeminjamanController::class, 'edit'])->name('edit');
        Route::patch('{peminjaman}', [PeminjamanController::class, 'update'])->name('update');
        Route::delete('delete/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('destroy');
    });

    Route::middleware('role:petugas,admin')->group(function () {
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('index');
            Route::get('print/{idpinjam}', [LaporanController::class, 'print'])->name('print');
            Route::get('print-all', [LaporanController::class, 'printAll'])->name('printAll');
        });
        Route::resource('alat', AlatController::class)->only(['index']);
    });

    // User detail view
    Route::prefix('alat')->name('alat.')->group(function () {
        Route::get('{alat}', [AlatController::class, 'show'])->whereNumber('alat')->name('show');
        Route::get('edit/{alat}', [AlatController::class, 'edit'])->name('edit');
        Route::put('edit/{alat}', [AlatController::class, 'update']);
    });

    Route::prefix('alat-masuk')->name('alat-masuk.')->group(function () {
        Route::get('/', [AlatMasukController::class, 'index'])->name('index');
        Route::get('create', [AlatMasukController::class, 'create'])->name('create');
        Route::post('create', [AlatMasukController::class, 'store']);
        Route::get('show/{alatMasuk}', [AlatMasukController::class, 'show'])->name('show');
        Route::get('edit/{alatMasuk}', [AlatMasukController::class, 'edit'])->name('edit');
        Route::delete('delete/{alatMasuk}', [AlatMasukController::class, 'destroy'])->name('destroy');
    });

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::prefix('alat')->name('alat.')->group(function () {
            Route::get('/', [AlatController::class, 'index'])->name('index');
            Route::get('create', [AlatController::class, 'create'])->name('create');
            Route::post('create', [AlatController::class, 'store'])->name('store');
            Route::get('edit/{itemId}', [AlatController::class, 'edit'])->name('edit');
            Route::put('edit/{itemId}', [AlatController::class, 'update'])->name('update');
            Route::delete('destroy/{alat}', [AlatController::class, 'destroy'])->name('destroy');
        });
        Route::resource('users', UserController::class);
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    });
});

require __DIR__ . '/auth.php';

