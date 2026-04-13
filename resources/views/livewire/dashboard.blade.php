<?php

use App\Models\Alat;
use App\Models\Peminjaman;
use Livewire\Volt\Component;

new class extends Component {
    public $totalAlat;
    public $peminjamanAktif;
    public $lowStock;

    public function mount(): void
    {
        if (auth()->user()->role === 'admin') {
            $this->totalAlat = Alat::count();
            $this->peminjamanAktif = Peminjaman::whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])->count();
            $this->lowStock = Alat::where('qty', '<', 5)->count();
        } else {
            $this->peminjamanAktif = auth()->user()->peminjaman()->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])->count();
            $this->peminjamanSelesai = auth()->user()->peminjaman()->where('status', 'dikembalikan')->count();
            $this->totalAlat = Alat::where('qty', '>', 0)->count();
        }
    }
}; ?>

<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->

                <div id="stats" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white/20 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium opacity-90">Total Alat</p>
                            <p class="text-3xl font-bold">{{ $totalAlat }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white/20 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium opacity-90">Peminjaman Aktif</p>
                            <p class="text-3xl font-bold">{{ $peminjamanAktif }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white/20 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium opacity-90">Stok Rendah</p>
                            <p class="text-3xl font-bold">{{ $lowStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white/20 rounded-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium opacity-90">Total User</p>
                            <p class="text-3xl font-bold">{{ auth()->user()->role === 'admin' ? \App\Models\User::count() : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="/alat" wire:navigate class="block bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-blue-200">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Kelola Alat</h3>
                        <p class="text-gray-600">Lihat, tambah, edit alat dan kategori</p>
                    </div>
                </a>

                <a href="/peminjaman" wire:navigate class="block bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-emerald-200">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Peminjaman</h3>
                        <p class="text-gray-600">Kelola peminjaman dan pengembalian</p>
                    </div>
                </a>

                <a href="/alat-masuk" wire:navigate class="block bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-purple-200">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Alat Masuk</h3>
                        <p class="text-gray-600">Tambah stok alat baru</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </x-app-layout>
</div>

