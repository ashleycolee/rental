@extends('layouts.user-home')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-6 lg:p-12">
    <div class="max-w-6xl mx-auto">
        <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                    <span class="hover:text-primary cursor-pointer transition-colors">Inventory</span>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="font-medium text-slate-900">Tambah Stok</span>
                </nav>
                <h1 class="text-3xl lg:text-4xl font-bold tracking-tight text-slate-900 font-jakarta">
                    Restock <span class="text-indigo-600">Alat</span>
                </h1>
                <p class="mt-2 text-slate-500">Input penambahan stok logistik secara akurat.</p>
            </div>
            
            <a href="{{ route('alat-masuk.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-semibold text-sm hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-7">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                    <div class="p-8 lg:p-10">
                        <form method="POST" action="{{ route('alat-masuk.create') }}" class="space-y-8">
                            @csrf

                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Pilih Barang</label>
                                <div class="relative">
                                    <select name="idalat" id="alatSelect" required 
                                            class="appearance-none w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-medium focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none cursor-pointer">
                                        <option value="" disabled selected>Pilih alat dari database...</option>
                                        @foreach($alat as $item)
                                            <option value="{{ $item->idalat }}" 
                                                    data-nama="{{ $item->namaalat }}" 
                                                    data-kategori="{{ $item->kategori->namakategori }}" 
                                                    data-qty="{{ $item->qty }}" 
                                                    data-gambar="{{ $item->gambaralat }}">
                                                {{ $item->namaalat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <span class="material-symbols-outlined">expand_more</span>
                                    </div>
                                </div>
                                @error('idalat') <p class="text-xs text-red-500 mt-1 ml-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Jumlah Masuk</label>
                                    <input name="qty" type="number" min="1" value="{{ old('qty', 1) }}" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-xl font-bold text-slate-800 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none"
                                           placeholder="0">
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest ml-1">Tanggal Terima</label>
                                    <input name="tglmasuk" type="date" value="{{ old('tglmasuk', date('Y-m-d')) }}" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-medium focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none">
                                </div>
                            </div>

                            <div class="pt-6">
                                <button type="submit" 
                                        class="w-full bg-indigo-600 hover:bg-indigo-600 text-white font-bold py-5 rounded-2xl shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3 group">
                                    <span class="material-symbols-outlined group-hover:rotate-12 transition-transform">inventory_2</span>
                                    Konfirmasi Tambah Stok
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div id="alatPreview" class="bg-indigo-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-100 hidden opacity-0 transition-opacity duration-500">
                    <div class="flex items-center gap-5">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-2xl p-2 border border-white/30 overflow-hidden">
                            <img id="previewImg" src="" class="w-full h-full object-cover rounded-lg" alt="Preview">
                        </div>
                        <div>
                            <span id="previewKategori" class="text-[10px] font-black uppercase tracking-widest bg-white/20 px-3 py-1 rounded-full">-</span>
                            <h3 id="previewNama" class="text-2xl font-bold mt-2 leading-tight">-</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                    <h4 class="text-slate-900 font-bold mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-indigo-500">analytics</span>
                        Ringkasan Stok
                    </h4>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-slate-50">
                            <span class="text-slate-500 text-sm">Stok Saat Ini</span>
                            <span id="stokSaatIni" class="font-bold text-slate-800">0</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-slate-50">
                            <span class="text-slate-500 text-sm text-indigo-600">Stok Masuk (+)</span>
                            <span id="jumlahMasuk" class="font-bold text-indigo-600">0</span>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-slate-900 font-bold text-lg">Total Akhir</span>
                            <div class="text-right">
                                <span id="totalBaru" class="text-3xl font-black text-emerald-500">0</span>
                                <p class="text-[10px] text-slate-400 font-medium">UNIT TOTAL</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100 flex gap-4">
                    <span class="material-symbols-outlined text-amber-600">info</span>
                    <p class="text-xs text-amber-800 leading-relaxed font-medium">
                        Pastikan jumlah fisik alat sesuai dengan data yang diinput untuk menjaga validitas inventaris.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const alatSelect = document.getElementById('alatSelect');
    const qtyInput = document.querySelector('input[name="qty"]');
    const previewContainer = document.getElementById('alatPreview');

    function updateUI() {
        const option = alatSelect.options[alatSelect.selectedIndex];
        
        if (option.value) {
            // Tampilkan preview dengan animasi simple
            previewContainer.classList.remove('hidden');
            setTimeout(() => previewContainer.classList.add('opacity-100'), 10);

            document.getElementById('previewNama').textContent = option.dataset.nama;
            document.getElementById('previewKategori').textContent = option.dataset.kategori;
            document.getElementById('previewImg').src = option.dataset.gambar ? `/storage/${option.dataset.gambar}` : 'https://placehold.co/200x200?text=No+Image';
            
            // Hitung Angka
            const current = parseInt(option.dataset.qty) || 0;
            const added = parseInt(qtyInput.value) || 0;
            
            document.getElementById('stokSaatIni').textContent = current;
            document.getElementById('jumlahMasuk').textContent = `+${added}`;
            document.getElementById('totalBaru').textContent = current + added;
        } else {
            previewContainer.classList.add('hidden');
            previewContainer.classList.remove('opacity-100');
        }
    }

    alatSelect.addEventListener('change', updateUI);
    qtyInput.addEventListener('input', updateUI);
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .font-jakarta {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Custom scrollbar untuk select */
    select::-webkit-scrollbar {
        width: 8px;
    }
    select::-webkit-scrollbar-thumb {
        background: #E2E8F0;
        border-radius: 10px;
    }
</style>
@endsection