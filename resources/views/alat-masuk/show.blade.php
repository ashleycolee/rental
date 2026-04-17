<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ route('alat-masuk.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Alat Masuk
                </a>
            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                {{-- Content Grid --}}
                <div class="p-6 lg:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                        {{-- Left: Image Preview --}}
                        <div class="space-y-4">
                            @if($alatMasuk->alat->gambaralat)
                                <div class="aspect-square rounded-xl overflow-hidden shadow-sm">
                                    <img
                                        src="{{ asset('storage/' . $alatMasuk->alat->gambaralat) }}"
                                        alt="{{ $alatMasuk->alat->namaalat }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                            @else
                                <div class="aspect-square rounded-xl bg-gray-100 flex items-center justify-center shadow-sm">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Right: Main Info --}}
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                                    {{ $alatMasuk->alat->namaalat }}
                                </h1>
                                <p class="text-gray-600">
                                    {{ $alatMasuk->alat->spesifikasi ?? 'Tidak ada spesifikasi' }}
                                </p>
                            </div>

                            <div>
                                @if($alatMasuk->alat->qty > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Stok tersedia: {{ $alatMasuk->alat->qty }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Stok habis
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Detail Info Section --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Alat Masuk</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">ID Masuk</label>
                                <p class="font-semibold text-gray-900">#{{ $alatMasuk->idmasuk }}</p>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Tanggal Masuk</label>
                                <p class="font-semibold text-gray-900">{{ $alatMasuk->tglmasuk->format('d M Y') }}</p>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm text-gray-500 mb-1">Jumlah Masuk</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path>
                                        <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
                                    </svg>
                                    {{ $alatMasuk->qty }} unit
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
