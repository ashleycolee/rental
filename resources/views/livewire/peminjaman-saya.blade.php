<?php

use App\Models\Peminjaman;
use App\Models\Alat;
use Livewire\WithPagination;
use Livewire\Volt\Component;

new class extends Component {
    use WithPagination;
    
    public $search = '';
    
    public function render(): \Illuminate\View\View
    {
        $peminjaman = Peminjaman::with(['alat.kategori', 'user'])
            ->where('iduser', auth()->id())
            ->when($this->search, function($query) {
                $query->whereHas('alat', fn($q) => $q->where('namaalat', 'like', '%'.$this->search.'%'))
                    ->orWhereHas('alat.kategori', fn($q) => $q->where('namakategori', 'like', '%'.$this->search.'%'));
            })
            ->latest()
            ->paginate(10);
        
        return view('livewire.peminjaman-saya', compact('peminjaman'));
    }
}; ?>

<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Riwayat Peminjaman Saya</h1>
        <p class="mt-2 text-xl text-gray-600">Daftar peminjaman yang Anda ajukan</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="relative max-w-md">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari peminjaman..." class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($peminjaman as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if($item->alat->gambaralat)
                                    <img src="{{ Storage::url($item->alat->gambaralat) }}" alt="{{ $item->alat->namaalat }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->alat->namaalat }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->alat->kategori->namakategori }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-mono text-sm">{{ $item->tglpinjam->format('d/m/Y') }}</div>
                                @if($item->tglkembali)
                                    <div class="text-xs text-gray-500">Kembali: {{ $item->tglkembali->format('d/m/Y') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 bg-gray-100 text-gray-800 text-sm font-semibold rounded-full">{{ $item->qty }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'disetujui' => 'bg-green-100 text-green-800',
                                        'dipinjam' => 'bg-blue-100 text-blue-800',
                                        'dikembalikan' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $statusLabels = [
                                        'menunggu' => 'Menunggu',
                                        'disetujui' => 'Disetujui',
                                        'dipinjam' => 'Dipinjam', 
                                        'dikembalikan' => 'Selesai'
                                    ];
                                @endphp
                                <span class="inline-flex px-3 py-1 {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800' }} text-xs font-semibold rounded-full">
                                    {{ $statusLabels[$item->status] ?? ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium space-x-2">
                                @if($item->status === 'menunggu')
                                    <span class="text-gray-400">Menunggu approval...</span>
                                @elseif($item->status === 'dipinjam' && !$item->kondisiakhir)
                                    <span class="text-orange-600 font-semibold">Belum dikembalikan</span>
                                @else
                                    @if($item->kondisiakhir)
                                        <span class="inline-flex px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Kondisi: {{ Str::limit($item->kondisiakhir, 20) }}</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada peminjaman</h3>
                                <p class="mt-1 text-sm">Pinjam barang pertama Anda di Beranda!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($peminjaman->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $peminjaman->links() }}
            </div>
        @endif
    </div>
</div>

