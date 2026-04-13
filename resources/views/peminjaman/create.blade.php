<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Peminjaman Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">
                <form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="idalat" :value="'Pilih Alat'" />
                            <select id="idalat" name="idalat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alat as $item)
                                    <option value="{{ $item->idalat }}" data-qty="{{ $item->qty }}">
                                        {{ $item->namaalat }} ({{ $item->kategori->namakategori }} - Stok: {{ $item->qty }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('idalat')" />
                        </div>

                        <div>
                            <x-input-label for="qty" :value="'Jumlah'" />
                            <x-text-input id="qty" name="qty" type="number" class="mt-1 block w-full" value="{{ old('qty') }}" min="1" required />
                            <x-input-error :messages="$errors->get('qty')" />
                        </div>

                        <div>
                            <x-input-label for="tglpinjam" :value="'Tanggal Pinjam'" />
                            <x-text-input id="tglpinjam" name="tglpinjam" type="date" class="mt-1 block w-full" value="{{ old('tglpinjam') }}" required />
                            <x-input-error :messages="$errors->get('tglpinjam')" />
                        </div>

                        <div>
                            <x-input-label for="tglkembali" :value="'Tanggal Kembali (Opsional)'" />
                            <x-text-input id="tglkembali" name="tglkembali" type="date" class="mt-1 block w-full" value="{{ old('tglkembali') }}" />
                            <x-input-error :messages="$errors->get('tglkembali')" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <a href="{{ route('peminjaman.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
