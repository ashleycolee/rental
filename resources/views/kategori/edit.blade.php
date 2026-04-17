<x-app-layout>


    <style>
        .font-plus-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="p-10 min-h-screen relative" style="background-color: #f7f9fb;">
        <!-- Fluid background decorative elements -->
        <div class="absolute top-[-10%] right-[-5%] w-96 h-96 rounded-full blur-3xl -z-10" style="background: rgba(70, 72, 212, 0.05);"></div>
        <div class="absolute bottom-[10%] left-[-5%] w-72 h-72 rounded-full blur-3xl -z-10" style="background: rgba(129, 39, 207, 0.05);"></div>

        <div class="max-w-2xl">
            <!-- Page Header -->
            <div class="mb-12">
                <a href="{{ route('kategori.index') }}" class="inline-flex items-center gap-2 font-semibold mb-6" style="color: #4648d4;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali
                </a>
                <h2 class="text-4xl font-extrabold font-plus-jakarta tracking-tight mb-2" style="color: #191c1e;">Edit Kategori</h2>
                <p style="color: #464554;">Perbarui informasi kategori <strong>{{ $kategori->namakategori }}</strong> dengan data yang lebih akurat.</p>
            </div>

            <!-- Form Card -->
            <form method="POST" action="{{ route('kategori.update', $kategori) }}" class="p-10 rounded-[1.5rem]" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                @csrf
                @method('PUT')
                <div class="space-y-8">
                    <!-- Category Name Input -->
                    <div>
                        <label for="namakategori" class="block text-sm font-semibold font-plus-jakarta mb-2" style="color: #191c1e;">Nama Kategori <span style="color: #ba1a1a;">*</span></label>
                        <input 
                            id="namakategori" 
                            name="namakategori" 
                            type="text" 
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all {{ $errors->has('namakategori') ? '' : '' }}" 
                            placeholder="Contoh: Peralatan Fotografi, Perangkat IT, dll"
                            value="{{ old('namakategori', $kategori->namakategori) }}" 
                            required 
                            autofocus 
                            style="background-color: #f2f4f6; border-color: #e0e3e5; color: #191c1e;" 
                            onfocus="this.style.backgroundColor='#ffffff'; this.style.borderColor='#4648d4'; this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'"
                            onblur="this.style.backgroundColor='#f2f4f6'; this.style.borderColor='#e0e3e5'; this.style.boxShadow='none'" />
                        @if ($errors->has('namakategori'))
                            <p class="mt-2 text-sm" style="color: #ba1a1a;">{{ $errors->first('namakategori') }}</p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-4 pt-6" style="border-top: 1px solid rgba(224, 227, 229, 0.3);">
                        <a href="{{ route('kategori.index') }}" class="px-6 py-3 rounded-xl font-semibold transition-colors" style="background-color: #e6e8ea; color: #191c1e;" onmouseover="this.style.backgroundColor='#d9dce0'" onmouseout="this.style.backgroundColor='#e6e8ea'">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 text-white rounded-xl font-bold hover:scale-105 transition-transform" style="background: linear-gradient(to right, #4648d4, #8127cf); box-shadow: 0 8px 20px -4px rgba(70, 72, 212, 0.3);">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined">edit</span>
                                Update Kategori
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

