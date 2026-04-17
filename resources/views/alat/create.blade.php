<x-app-layout>


    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px);
        }
        .kinetic-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
        }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    <div class="p-8 space-y-8" style="background-color: #f7f9fb; min-height: 100vh;">
        <!-- Fluid Background Elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] opacity-30 rounded-full blur-[120px] -z-10" style="background: radial-gradient(circle, #4648d4, transparent);"></div>
        <div class="absolute bottom-[5%] left-[5%] w-[300px] h-[300px] opacity-30 rounded-full blur-[100px] -z-10" style="background: radial-gradient(circle, #8127cf, transparent);"></div>

        <!-- Header -->
        <header>
            <h1 class="font-headline text-4xl font-extrabold tracking-tight mb-2" style="color: #191c1e;">Tambah Asset Baru</h1>
            <p class="font-medium" style="color: #464554;">Tambahkan item baru ke dalam koleksi inventaris.</p>
        </header>

        <!-- Main Form Container -->
        <div class="max-w-6xl mx-auto">
            <div class="glass-panel rounded-xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
                <!-- Left Side: Image Preview / Drag & Drop -->
                <div class="w-full md:w-1/3 p-8 flex flex-col" style="background-color: #f2f4f6;">
                    <h3 class="font-headline font-bold mb-6" style="color: #191c1e;">Preview & Media Asset</h3>
                    <div class="flex-1 flex flex-col gap-6">
                        <div class="relative group aspect-square rounded-xl overflow-hidden bg-white shadow-inner border-2 border-dashed border-outline-variant flex flex-col items-center justify-center text-center px-6">
                            <img id="preview-img" alt="Asset Preview" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity" style="display: none;">
                            <div class="relative z-10 flex flex-col items-center">
                                <span class="material-symbols-outlined text-4xl mb-2 drop-shadow-sm" style="color: #4648d4;">cloud_upload</span>
                                <p class="text-xs font-bold uppercase tracking-tighter" style="color: #191c1e;">Drag & Drop</p>
                                <p class="text-[10px] mt-1" style="color: #464554;">High-res PNG, JPG supported</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-white/50 border" style="border-color: rgba(118, 117, 134, 0.3);">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="material-symbols-outlined text-sm" style="color: #006387;">info</span>
                                    <span class="text-[10px] font-bold uppercase tracking-widest" style="color: #464554;">Metadata Note</span>
                                </div>
                                <p class="text-xs leading-relaxed italic" style="color: #464554;">
                                    "Item berharga tinggi harus menyertakan nomor seri yang jelas di kolom deskripsi untuk log audit."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form Fields -->
                <div class="flex-1 p-8 md:p-12 overflow-y-auto">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h2 class="font-headline text-3xl font-extrabold tracking-tight" style="color: #191c1e;">Detail Asset</h2>
                            <p class="font-medium text-sm mt-1" style="color: #464554;">Menyempurnakan identitas item dalam kumpulan kurasi.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('alat.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold uppercase tracking-widest ml-1" style="color: #767586;">Nama Alat</label>
                                <input id="namaalat" name="namaalat" type="text" class="w-full border-none border-b-2 border-transparent focus:border-primary rounded-xl px-4 py-3 font-medium transition-all focus:ring-0" style="background-color: #e6e8ea;" value="{{ old('namaalat') }}" required autofocus />
                                <x-input-error for="namaalat" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold uppercase tracking-widest ml-1" style="color: #767586;">Kategori</label>
                                <select id="idkategori" name="idkategori" class="w-full border-none border-b-2 border-transparent focus:border-primary rounded-xl px-4 py-3 font-medium transition-all focus:ring-0 appearance-none" style="background-color: #e6e8ea;" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $id => $nama)
                                        <option value="{{ $id }}" {{ old('idkategori') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="idkategori" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold uppercase tracking-widest ml-1" style="color: #767586;">Stok/Jumlah</label>
                                <input id="qty" name="qty" type="number" min="0" class="w-full border-none border-b-2 border-transparent focus:border-primary rounded-xl px-4 py-3 font-medium transition-all focus:ring-0" style="background-color: #e6e8ea;" value="{{ old('qty', 0) }}" required />
                                <x-input-error for="qty" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-bold uppercase tracking-widest ml-1" style="color: #767586;">Spesifikasi</label>
                            <textarea id="spesifikasi" name="spesifikasi" rows="4" class="w-full border-none border-b-2 border-transparent focus:border-primary rounded-xl px-4 py-3 font-medium transition-all focus:ring-0 resize-none" style="background-color: #e6e8ea;">{{ old('spesifikasi') }}</textarea>
                            <x-input-error for="spesifikasi" />
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-bold uppercase tracking-widest ml-1" style="color: #767586;">Gambar (Opsional)</label>
                            <input id="gambaralat" name="gambaralat" type="file" accept="image/*" class="hidden" onchange="previewImage(this)" />
                            <div class="w-full border-2 border-dashed rounded-xl px-4 py-8 text-center cursor-pointer hover:border-primary transition-all" style="border-color: rgba(118, 117, 134, 0.5);" onclick="document.getElementById('gambaralat').click()">
                                <span class="material-symbols-outlined text-2xl mb-2" style="color: #4648d4;">upload_file</span>
                                <p class="text-sm font-medium" style="color: #191c1e;">Klik untuk memilih gambar</p>
                                <p class="text-xs" style="color: #464554;">PNG, JPG hingga 5MB</p>
                            </div>
                            <x-input-error for="gambaralat" />
                        </div>

                        <!-- Availability Timeline Component -->
                        <div class="pt-4">
                            <label class="text-xs font-bold uppercase tracking-widest ml-1 block mb-4" style="color: #767586;">Ketersediaan Awal</label>
                            <div class="h-2 w-full rounded-full overflow-hidden flex" style="background-color: #e0e3e5;">
                                <div class="h-full w-full" style="background-color: #6063ee;"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-[10px] font-bold" style="color: #4648d4;">100% Tersedia</span>
                                <span class="text-[10px] font-bold" style="color: #767586;">Siap Digunakan</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-8 mt-4 border-t" style="border-color: rgba(224, 227, 229, 0.3);">
                            <a href="{{ route('alat.index') }}" class="px-8 py-3 rounded-xl font-headline font-bold hover:bg-surface-container-high transition-all" style="color: #464554; background-color: transparent;">Batal</a>
                            <button type="submit" class="kinetic-gradient text-white px-10 py-3 rounded-xl font-headline font-bold shadow-lg scale-102 hover:scale-105 active:scale-95 transition-all" style="box-shadow: 0 4px 14px 0 rgba(70, 72, 212, 0.2);">
                                Simpan Asset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview-img');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.style.opacity = '1';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>

