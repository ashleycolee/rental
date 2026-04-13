<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Kategori
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
                <form method="GET" action="{{ route('kategori.index') }}" class="flex-grow">
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
                <a href="{{ route('kategori.create') }}" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 whitespace-nowrap">
                    Tambah Kategori
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($kategoris as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->namakategori }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $item->alat()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('kategori.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                            Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kategori {{ $item->namakategori }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada kategori</h3>
                                            <p class="mt-1">Mulai dengan <a href="{{ route('kategori.create') }}" class="text-blue-600 hover:underline">menambahkan kategori baru</a>.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $kategoris->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

