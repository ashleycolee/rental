<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Peminjaman #{{ $peminjaman->idpinjam }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-8 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-emerald-100">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Peminjaman {{ $peminjaman->idpinjam }}</h1>
                            <p class="text-xl text-gray-600 mt-1">Status: 
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @switch($peminjaman->status)
                                        @case('menunggu') bg-yellow-100 text-yellow-800 @break
                                        @case('disetujui') bg-green-100 text-green-800 @break
                                        @case('dipinjam') bg-blue-100 text-blue-800 @break
                                        @case('dikembalikan') bg-gray-100 text-gray-800 @break
                                    @endswitch">
                                    {{ ucfirst(str_replace('_', ' ', $peminjaman->status)) }}
                                </span>
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-5xl font-bold text-emerald-600">{{ $peminjaman->qty }}</span>
                            <p class="text-lg text-gray-600">Unit</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Alat Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Alat</h3>
                        <div class="flex items-start space-x-4">
                            @if($peminjaman->alat->gambaralat)
                                <img src="{{ Storage::url($peminjaman->alat->gambaralat) }}" alt="{{ $peminjaman->alat->namaalat }}" class="w-24 h-24 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $peminjaman->alat->namaalat }}</h4>
                                <p class="text-sm text-gray-600">{{ $peminjaman->alat->kategori->namakategori }}</p>
                                <p class="text-sm text-gray-500 mt-1">Spesifikasi: {{ $peminjaman->alat->spesifikasi ?? 'Tidak ada' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal & User -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tanggal</h3>
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Pinjam:</span>
                                <span class="text-lg font-semibold">{{ $peminjaman->tglpinjam->format('d M Y') }}</span>
                            </div>
                            @if($peminjaman->tglkembali)
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Kembali:</span>
                                    <span class="text-lg font-semibold">{{ $peminjaman->tglkembali->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Peminjam</h3>
                        <div>
                            <p class="font-semibold">{{ $peminjaman->user->namalengkap }}</p>
                            <p class="text-sm text-gray-600">{{ $peminjaman->user->username }}</p>
                            <p class="text-sm text-gray-500">{{ $peminjaman->user->identitas }}</p>
                            <p class="text-sm text-gray-500">{{ $peminjaman->user->nohp }}</p>
                        </div>
                    </div>
                </div>

                @if($peminjaman->kondisiakhir)
                <div class="p-8 bg-amber-50 border-t border-amber-200">
                    <h3 class="text-lg font-semibold text-amber-900 mb-3">Kondisi Akhir</h3>
                    <p class="text-amber-900 leading-relaxed">{{ $peminjaman->kondisiakhir }}</p>
                </div>
                @endif

                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3 justify-end">
                        <a href="{{ route('peminjaman.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            Kembali
                        </a>
                        
                        @if(Auth::user()->role === 'admin' && $peminjaman->status === 'menunggu')
                            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-lg transition-all duration-200" onclick="return confirm('Setujui peminjaman? Stok akan berkurang.')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Setujui
                                </button>
                            </form>
                        @endif

                        @if(Auth::user()->role === 'admin' && in_array($peminjaman->status, ['disetujui', 'dipinjam']))
                            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="dikembalikan">
                                <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 shadow-lg transition-all duration-200" onclick="return confirm('Konfirmasi dikembalikan? Stok akan ditambah kembali.')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V7m6 4h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-6 0h-2a2 2 0 01-2-2v-6a2 2 0 012-2h2"></path>
                                    </svg>
                                    Kembalikan
                                </button>
                            </form>
                        @endif

                        @if(Auth::user()->role === 'admin')
                            <form method="POST" action="{{ route('peminjaman.destroy', $peminjaman) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors" onclick="return confirm('Hapus peminjaman ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
