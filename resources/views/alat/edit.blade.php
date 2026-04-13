<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Alat: {{ $alat->namaalat }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('alat.update', $alat) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white shadow-sm rounded-lg p-8">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="namaalat" :value="'Nama Alat'" />
                            <x-text-input id="namaalat" name="namaalat" type="text" class="mt-1 block w-full" value="{{ $alat->namaalat }}" required autofocus />
                            <x-input-error for="namaalat" />
                        </div>

                        <div>
                            <x-input-label for="idkategori" :value="'Kategori'" />
                            <select id="idkategori" name="idkategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $id => $nama)
                                    <option value="{{ $id }}" {{ old('idkategori', $alat->idkategori) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="idkategori" />
                        </div>

                        <div>
                            <x-input-label for="gambaralat" :value="'Gambar Baru (Opsional)'" />
                            <input id="gambaralat" name="gambaralat" type="file" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @if($alat->gambaralat)
                                <img src="{{ asset('storage/' . $alat->gambaralat) }}" alt="Current" class="mt-2 w-32 h-32 object-cover rounded-lg">
                                <p class="text-sm text-gray-500 mt-1">Gambar saat ini akan diganti jika upload baru</p>
                            @endif
                            <x-input-error for="gambaralat" />
                        </div>

                        <div class="col-span-2">
                            <x-input-label for="spesifikasi" :value="'Spesifikasi'" />
                            <textarea id="spesifikasi" name="spesifikasi" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('spesifikasi', $alat->spesifikasi) }}</textarea>
                            <x-input-error for="spesifikasi" />
                        </div>

                        <div>
                            <x-input-label for="qty" :value="'Stok'" />
                            <x-text-input id="qty" name="qty" type="number" min="0" class="mt-1 block w-full" value="{{ old('qty', $alat->qty) }}" required />
                            <x-input-error for="qty" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <a href="{{ route('alat.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Update Alat
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

