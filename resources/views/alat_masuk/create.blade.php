<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Stok Alat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('alat-masuk.store') }}">
                @csrf
                <div class="bg-white shadow-sm rounded-lg p-8">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="idalat" :value="'Pilih Alat'" />
                            <select id="idalat" name="idalat" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                                <option value="">Pilih Alat</option>
                                @foreach($alat as $item)
                                    <option value="{{ $item->idalat }}" {{ old('idalat') == $item->idalat ? 'selected' : '' }}>
                                        {{ $item->namaalat }} ({{ $item->kategori->namakategori }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="idalat" />
                        </div>

                        <div>
                            <x-input-label for="qty" :value="'Jumlah Stok Masuk'" />
                            <x-text-input id="qty" name="qty" type="number" min="1" class="mt-1 block w-full" :value="old('qty')" required />
                            <x-input-error for="qty" />
                        </div>

                        <div>
                            <x-input-label for="tglmasuk" :value="'Tanggal Masuk'" />
                            <x-text-input id="tglmasuk" name="tglmasuk" type="date" class="mt-1 block w-full" :value="old('tglmasuk', date('Y-m-d'))" required />
                            <x-input-error for="tglmasuk" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <a href="{{ route('alat-masuk.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                                Tambah Stok
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
