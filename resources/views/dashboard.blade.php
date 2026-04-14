<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Total Alat</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Alat::count() }}</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kategori</h3>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Kategori::count() }}</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Peminjaman</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Peminjaman::count() }}</p>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="/alat" class="block p-6 bg-linear-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transition-all">
                    <h3 class="text-xl font-bold mb-2">Kelola Alat</h3>
                    <p>Tambah/Edit Alat & Kategori</p>
                </a>
                <a href="/peminjaman" class="block p-6 bg-linear-to-r from-emerald-500 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-emerald-600 hover:to-emerald-700 transition-all">
                    <h3 class="text-xl font-bold mb-2">Peminjaman</h3>
                    <p>Kelola Peminjaman</p>
                </a>
                <a href="/alat-masuk" class="block p-6 bg-linear-to-r from-purple-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-purple-600 hover:to-purple-700 transition-all">
                    <h3 class="text-xl font-bold mb-2">Alat Masuk</h3>
                    <p>Tambah Stok</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
