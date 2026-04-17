@extends('layouts.user-home')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">

<div class="min-h-screen bg-[#F8FAFC] p-6 lg:p-12">
    <div class="max-w-7xl mx-auto">
        
        <header class="mb-12">
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                <span class="hover:text-primary cursor-pointer transition-colors">Peminjaman</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="font-medium text-slate-900">Form Pengajuan</span>
            </nav>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-slate-900 mb-3 font-jakarta">
                Ajukan <span class="text-indigo-600">Peminjaman</span>
            </h1>
            <p class="text-lg text-slate-500 max-w-xl">Lengkapi detail untuk meminjam barang dari katalog perusahaan.</p>
        </header>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white border border-slate-100 rounded-[2rem] shadow-xl shadow-slate-200/50 p-6 md:p-8 flex flex-col md:flex-row gap-8 transition-all duration-500 opacity-0 transform translate-y-4" id="itemPreview" style="display: none;">
                    <div class="w-full md:w-56 h-56 rounded-2xl overflow-hidden relative shadow-inner bg-slate-50">
                        <img alt="Preview" id="previewImg" class="w-full h-full object-cover" src=""/>
                        <div class="absolute top-4 left-4">
                            <span id="previewKategori" class="bg-white/90 backdrop-blur-md text-indigo-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm border border-slate-100">-</span>
                        </div>
                    </div>
                    
                    <div class="flex-1 flex flex-col py-2">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                            <span id="previewStatus" class="text-[11px] font-bold uppercase tracking-[0.2em] text-emerald-600 font-jakarta">Unit Tersedia</span>
                        </div>
                        <h2 id="previewName" class="text-2xl md:text-3xl font-bold text-slate-900 mb-3 font-jakarta">-</h2>
                        <p id="previewDesc" class="text-slate-500 text-sm mb-6 leading-relaxed max-w-md">Pilih alat untuk melihat detail deskripsi di sini.</p>
                        
                        <div class="mt-auto flex flex-wrap gap-4 pt-4 border-t border-slate-50">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                                <span class="material-symbols-outlined text-[18px]">fingerprint</span>
                                <span id="previewId">-</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                <span>Lab Utama</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <section class="bg-white border border-slate-100 rounded-[2rem] shadow-xl shadow-slate-200/50 p-8 md:p-10">
                    <h3 class="text-xl font-bold mb-10 text-slate-900 font-jakarta flex items-center gap-3">
                        <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg material-symbols-outlined">description</span> 
                        Formulir Peminjaman
                    </h3>
                    
                    <form method="POST" action="{{ route('peminjaman.create') }}" id="borrowForm" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <div class="space-y-3 group">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1 group-focus-within:text-indigo-600 transition-colors">Pilih Item dari Katalog</label>
                            <div class="relative">
                                <select id="idalat" name="idalat" required
                                        class="appearance-none w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-medium focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none cursor-pointer">
<option value="" disabled selected {{ !isset($quickId) ? 'selected' : '' }}>-- Cari Alat --</option>
@if(isset($quickId))
    @php
        $selectedAlat = $alat->firstWhere('idalat', $quickId);
    @endphp
    <option value="{{ $selectedAlat->idalat ?? '' }}" selected>
        {{ $selectedAlat->namaalat ?? '' }} ({{ $selectedAlat->kategori->namakategori ?? '' }})
    </option>
@endif
                                    @foreach($alat as $item)
                                        <option value="{{ $item->idalat }}" 
                                                data-nama="{{ $item->namaalat }}" 
                                                data-kategori="{{ $item->kategori->namakategori }}" 
                                                data-qty="{{ $item->qty }}" 
                                                data-id="{{ $item->idalat }}" 
                                                data-gambar="{{ $item->gambaralat }}">
                                            {{ $item->namaalat }} ({{ $item->kategori->namakategori }})
                                        </option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">unfold_more</span>
                            </div>
                            <x-input-error :messages="$errors->get('idalat')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nama Peminjam</label>
                                <div class="relative group">
                                    <input class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-slate-500 font-semibold cursor-not-allowed" 
                                           readonly type="text" value="{{ $user->namalengkap ?? $user->username ?? 'User' }}"/>
                                    <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-slate-300">lock</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Jumlah Unit</label>
                                <input type="number" id="qty" name="qty" 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-bold focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" 
                                       value="1" min="1" required />
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Mulai</label>
                                <div class="relative">
                                    <input id="tglpinjam" name="tglpinjam" type="date" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-medium focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" />
                                </div>
                                <x-input-error :messages="$errors->get('tglpinjam')" class="mt-2" />
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Estimasi Pengembalian</label>
                                <div class="relative">
                                    <input id="tglkembali" name="tglkembali" type="date" required
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 font-medium focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" />
                                </div>
                                <x-input-error :messages="$errors->get('tglkembali')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Alasan Peminjaman / Catatan</label>
                            <textarea id="catatan" name="catatan" rows="4" 
                                      class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-800 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none resize-none" 
                                      placeholder="Contoh: Untuk keperluan audit proyek minggu depan..."></textarea>
                        </div>
                    </form>
                </section>
            </div>
            
            <aside class="lg:col-span-4 lg:sticky lg:top-12 space-y-6">
                <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-2xl shadow-indigo-200 overflow-hidden relative group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-xl font-bold mb-8 font-jakarta relative z-10 flex items-center gap-2">
                        <span class="material-symbols-outlined text-indigo-400">receipt_long</span> Ringkasan
                    </h3>
                    
                    <div class="space-y-6 relative z-10">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-black text-indigo-300 uppercase tracking-widest">Item Terpilih</span>
                            <p id="summaryItem" class="text-lg font-bold text-white truncate">-</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-black text-indigo-300 uppercase tracking-widest">Jumlah</span>
                                <p id="summaryQty" class="text-lg font-bold text-white">-</p>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-black text-indigo-300 uppercase tracking-widest">Status</span>
                                <div>
                                    <span class="bg-indigo-500/30 text-indigo-200 px-3 py-1 rounded-full text-[10px] font-black tracking-widest">DRAFT</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-6 border-t border-white/10">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-indigo-300">Wajib Kembali</span>
                                <span id="estReturn" class="text-sm font-bold text-white font-jakarta">-</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 flex flex-col gap-4 relative z-10">
                        <button type="submit" form="borrowForm" 
                                class="w-full py-5 rounded-2xl font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-xl shadow-indigo-900/20 transition-all duration-300 hover:-translate-y-1 active:scale-95 font-jakarta">
                            Kirim Pengajuan
                        </button>
                        <a href="{{ route('peminjaman.index') }}" 
                           class="w-full py-4 rounded-2xl font-bold text-slate-400 bg-white/5 border border-white/10 hover:bg-white/10 hover:text-white transition-all duration-300 text-center text-sm font-jakarta block">
                            Batalkan
                        </a>
                    </div>
                </div>
                
                <div class="bg-white border border-slate-100 p-6 rounded-[1.5rem] shadow-sm flex gap-4">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">verified_user</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 mb-1 font-jakarta">Proses Peninjauan</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed font-medium">Pengajuan akan dikaji oleh Admin (Max 24 Jam). Anda akan menerima notifikasi status melalui dashboard.</p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<style>
    .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.4;
        cursor: pointer;
    }
    
    /* Smooth Show Animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .show-preview {
        display: flex !important;
        animation: fadeInUp 0.5s ease forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAlat = document.getElementById('idalat');
        const preview = document.getElementById('itemPreview');
        const qty = document.getElementById('qty');
        
        selectAlat.addEventListener('change', function() {
            const option = this.options[this.selectedIndex];
            if (option.value) {
                // Preview Animation & Visibility
                preview.classList.add('show-preview');
                
                // Update Data
                document.getElementById('previewName').textContent = option.dataset.nama;
                document.getElementById('previewKategori').textContent = option.dataset.kategori;
                document.getElementById('previewId').textContent = "ID: " + option.dataset.id;
                document.getElementById('previewStatus').textContent = 'Tersedia (' + option.dataset.qty + ' Unit)';
                document.getElementById('previewDesc').textContent = "Aset kategori " + option.dataset.kategori + " dengan sisa stok saat ini sebanyak " + option.dataset.qty + " unit.";
                
                // Update Image
                const img = document.getElementById('previewImg');
                img.src = option.dataset.gambar ? '/storage/' + option.dataset.gambar : 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=500&q=80';
                
                // Update Summary
                document.getElementById('summaryItem').textContent = option.dataset.nama;
                document.getElementById('summaryQty').textContent = qty.value + ' Unit';
                
                updateEstReturn();
            } else {
                preview.classList.remove('show-preview');
            }
        });
        
        qty.addEventListener('input', function() {
            document.getElementById('summaryQty').textContent = (this.value || 0) + ' Unit';
        });
        
        ['tglpinjam', 'tglkembali'].forEach(id => {
            document.getElementById(id).addEventListener('change', updateEstReturn);
        });
        
        function updateEstReturn() {
            const dateVal = document.getElementById('tglkembali').value;
            if (dateVal) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('estReturn').textContent = new Date(dateVal).toLocaleDateString('id-ID', options);
            } else {
                document.getElementById('estReturn').textContent = "-";
            }
        }
    });
</script>
@endsection