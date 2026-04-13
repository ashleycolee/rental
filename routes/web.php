<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', function() {
    if(auth()->user()->role === 'user') {
        abort(403, 'Akses hanya untuk admin dan petugas.');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');
    
    // Home - User e-commerce landing
    Route::get('/home', function() {
        if(auth()->user()->role !== 'user') {
            abort(403, 'Akses hanya untuk user.');
        }
        return view('home');
    })->name('home');
    
    // Peminjaman - available to all authenticated users (admin + user)
    Route::get('/peminjaman-saya', function() {
        if(auth()->user()->role !== 'user') {
            abort(403, 'Akses hanya untuk user.');
        }
        return view('livewire.peminjaman-saya');
    })->name('peminjaman.user');
    Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class);
    
    // Petugas + Admin routes (alat index only)
    Route::middleware('role:petugas,admin')->group(function () {
        Route::resource('alat', \App\Http\Controllers\AlatController::class)->only(['index']);
    });

    // User detail view
    Route::get('/alat/{alat}', [\App\Http\Controllers\AlatController::class, 'show'])
        ->whereNumber('alat')
        ->name('alat.show');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('alat', \App\Http\Controllers\AlatController::class);
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
        Route::resource('alat-masuk', \App\Http\Controllers\AlatMasukController::class);
        Route::resource('manageaccount', \App\Http\Controllers\UserController::class)->names('users');
    });
});

require __DIR__.'/auth.php';
