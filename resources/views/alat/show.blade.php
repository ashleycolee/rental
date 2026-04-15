<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Alat: {{ $alat->namaalat }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            @if($alat->gambaralat)
                                <img src="{{ asset('storage/' . $alat->gambaralat) }}" alt="{{ $alat->namaalat }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500 text-lg">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $alat->namaalat }}</h3>
                                <p class="text-4xl font-bold text-gray-900 mt-2">{{ $alat->qty }}</p>
                                <span class="px-4 py-2 text-lg font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $alat->kategori->namakategori ?? 'Kategori Tidak Ditemukan' }}
                                </span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Spesifikasi:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $alat->spesifikasi ?? 'Tidak ada spesifikasi' }}</p>
                            </div>
                            <div class="flex gap-4 pt-4">
                                @if(Auth::user()->role !== 'user')
                                <a href="{{ route('alat.edit', $alat) }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Edit
                                </a>
                                @endif
                                <a href="{{ Auth::user()->role === 'user' ? '/beranda' : route('alat.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                    {{ Auth::user()->role === 'user' ? 'Beranda' : 'Kembali' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

