@extends('layouts.user-home')

@section('content')
<div class="max-w-4xl mx-auto p-8">
    <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-2xl">edit_note</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900 font-headline">Update Status Peminjaman</h1>
                <p class="text-slate-600 mt-1">Ubah status peminjaman #{{ $peminjaman->idpinjam }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                        {{ substr($peminjaman->alat->namaalat, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-xl text-slate-900">{{ $peminjaman->alat->namaalat }}</h3>
                        <p class="text-sm text-slate-500">{{ $peminjaman->alat->kategori->namakategori }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500 block">Peminjam</span>
                        <span class="font-semibold text-slate-900">{{ $peminjaman->user->namalengkap ?? $peminjaman->user->username }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Tanggal Ajukan</span>
                        <span class="font-semibold text-slate-900">{{ $peminjaman->created_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Jumlah</span>
                        <span class="font-bold text-indigo-600">{{ $peminjaman->qty }} unit</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Status Saat Ini</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 rounded-2xl p-6">
                <h4 class="font-bold mb-4 text-slate-900">Catatan</h4>
                <p class="text-sm text-slate-600 whitespace-pre-wrap">{{ $peminjaman->catatan ?? 'Tidak ada catatan' }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Status Baru</label>
                    <select name="status" class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="menunggu" {{ old('status', $peminjaman->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ old('status', $peminjaman->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Kembali (Opsional)</label>
                    <input type="date" name="tglkembali" value="{{ old('tglkembali', $peminjaman->tglkembali) }}" class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                    <x-input-error :messages="$errors->get('tglkembali')" class="mt-2" />
                </div>
            </div>
            
            <div class="space-y-3">
                <label class="block text-sm font-bold text-slate-700 mb-2">Kondisi Akhir Alat (Opsional)</label>
                <textarea name="kondisiakhir" rows="3" class="w-full p-4 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-vertical" placeholder="Catat kondisi alat saat dikembalikan...">{{ old('kondisiakhir', $peminjaman->kondisiakhir) }}</textarea>
                <x-input-error :messages="$errors->get('kondisiakhir')" class="mt-2" />
            </div>

            <div class="flex gap-4 mt-12 pt-8 border-t border-slate-100">
                <a href="{{ route('peminjaman.index') }}" class="flex-1 md:flex-none px-8 py-4 font-bold text-slate-700 rounded-xl border border-slate-200 hover:bg-slate-50 transition-all text-center">
                    Kembali
                </a>
                <button type="submit" class="flex-1 md:flex-none px-12 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-600 hover:to-purple-700 shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-0.5">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
