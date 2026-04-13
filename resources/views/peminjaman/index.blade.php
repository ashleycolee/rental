<?php

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search & Create -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4">
                <form method="GET" action="{{ route('peminjaman.index') }}" class="flex-grow">
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID atau nama alat..." class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
                <a href="{{ route('peminjaman.create') }}" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 whitespace-nowrap">
                    Pinjam Baru
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $peminjaman->where('status', 'menunggu')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Disetujui</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $peminjaman->where('status', 'disetujui')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c.656 0 1.283.126 1.857.356"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Dipinjam</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $peminjaman->where('status', 'dipinjam')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Dikembalikan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $peminjaman->where('status', 'dikembalikan')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($peminjaman as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">#{{ $item->idpinjam }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->alat->namaalat }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->alat->kategori->namakategori }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->user->username ?? $item->user->namalengkap }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-sm font-semibold bg-gray-100 rounded-full">
                                            {{ $item->qty }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->tglpinjam->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = match($item->status) {
                                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                'disetujui' => 'bg-green-100 text-green-800',
                                                'dipinjam' => 'bg-blue-100 text-blue-800',
                                                'dikembalikan' => 'bg-gray-100 text-gray-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('peminjaman.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Lihat
                                        </a>
                                        <a href="{{ route('peminjaman.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                            Update Status
                                        </a>
                                        <form action="{{ route('peminjaman.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h10a2 2 0 012 2v2M6 20h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada peminjaman</h3>
                                            <p class="mt-1">Mulai dengan <a href="{{ route('peminjaman.create') }}" class="text-blue-600 hover:underline">meminjam alat</a>.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $peminjaman->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
