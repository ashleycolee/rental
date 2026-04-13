<?php

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alat Masuk (Tambah Stok)
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
                <form method="GET" action="{{ route('alat-masuk.index') }}" class="flex-grow">
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alat..." class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
                <a href="{{ route('alat-masuk.create') }}" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 whitespace-nowrap">
                    Tambah Stok
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($alatMasuk as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">#{{ $item->idmasuk }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $item->alat->namaalat }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->alat->kategori->namakategori }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                            +{{ $item->qty }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->tglmasuk->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('alat-masuk.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Lihat
                                        </a>
                                        <a href="{{ route('alat-masuk.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                            Edit
                                        </a>
                                        <form action="{{ route('alat-masuk.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus? Stok akan dikurangi.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada data alat masuk</h3>
                                            <p class="mt-1">Mulai dengan <a href="{{ route('alat-masuk.create') }}" class="text-blue-600 hover:underline">menambah stok</a>.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $alatMasuk->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
