<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori: {{ $kategori->namakategori }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('kategori.update', $kategori) }}">
                @csrf
                @method('PUT')
                <div class="bg-white shadow-sm rounded-lg p-8">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="namakategori" :value="'Nama Kategori'" />
                            <x-text-input id="namakategori" name="namakategori" type="text" class="mt-1 block w-full" value="{{ old('namakategori', $kategori->namakategori) }}" required autofocus />
                            <x-input-error for="namakategori" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <a href="{{ route('kategori.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Update Kategori
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

