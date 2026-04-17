<x-app-layout>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .status-badge {
            padding: 0.5rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .stock-badge {
            padding: 0.5rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
        }
    </style>

    <div class="p-8 space-y-8" style="background-color: #f7f9fb;">
        @if (session('success'))
            <div class="p-4 rounded-xl" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h2 class="text-4xl font-extrabold font-headline tracking-tight" style="color: #191c1e;">Data Alat</h2>
                <p class="mt-1 font-medium" style="color: #9ca3af;">Kelola inventaris barang dengan mudah</p>
            </div>
            <a href="{{ route('alat.create') }}" class="px-8 py-3.5 text-white rounded-xl font-bold hover:scale-105 hover:opacity-95 transition-all" style="background: linear-gradient(to bottom right, #4648d4, #8127cf); box-shadow: 0 8px 20px -4px rgba(70, 72, 212, 0.3);">
                + Tambah Alat
            </a>
        </div>

        <!-- Summary Section (Bento Style) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total Alat -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Total Alat</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #4648d4;">{{ $alat->total() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #e0e7ff; color: #4648d4;">
                        <span class="material-symbols-outlined text-3xl">inventory_2</span>
                    </div>
                </div>
            </div>

            <!-- Stok Tersedia -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(16, 185, 129, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Tersedia</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #10b981;">{{ $alat->where('qty', '>', 0)->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #d1fae5; color: #10b981;">
                        <span class="material-symbols-outlined text-3xl">check_circle</span>
                    </div>
                </div>
            </div>

            <!-- Low Stock -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(245, 158, 11, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Low Stock</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #f59e0b;">{{ $alat->where('qty', '<', 5)->where('qty', '>', 0)->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #fef3c7; color: #f59e0b;">
                        <span class="material-symbols-outlined text-3xl">warning</span>
                    </div>
                </div>
            </div>

            <!-- Habis -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(239, 68, 68, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Habis</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #ef4444;">{{ $alat->where('qty', 0)->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #fee2e2; color: #ef4444;">
                        <span class="material-symbols-outlined text-3xl">inventory</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="flex flex-col lg:flex-row gap-4 p-4 rounded-2xl" style="background-color: #f2f4f6;">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2" style="color: #9ca3af;">search</span>
                <form method="GET" action="{{ route('alat.index') }}" class="w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alat atau spesifikasi..." class="w-full pl-12 pr-4 py-3 border-none rounded-xl text-sm font-medium" style="background-color: #ffffff; color: #191c1e;" onfocus="this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'" onblur="this.style.boxShadow='none'"/>
                </form>
            </div>
            <div class="flex flex-wrap gap-3">
                <button class="p-3 text-slate-500 rounded-xl transition-colors" style="background-color: #ffffff;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='#ffffff'">
                    <span class="material-symbols-outlined">filter_list</span>
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="rounded-2xl shadow-sm overflow-hidden" style="background-color: #ffffff;">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr style="background-color: rgba(15, 23, 42, 0.03);">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Gambar</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Nama</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Kategori</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-center" style="color: #9ca3af;">Stok</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Spesifikasi</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-right" style="color: #9ca3af;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="border-top: 1px solid #e5e7eb;">
                        @forelse ($alat as $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;" onmouseover="this.style.backgroundColor='rgba(15, 23, 42, 0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-5">
                                    @if($item->gambaralat)
                                        <img src="{{ asset('storage/' . $item->gambaralat) }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-surface-container-high rounded-lg flex items-center justify-center text-xs text-gray-400">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div>
                                        <p class="font-bold" style="color: #191c1e;">{{ $item->namaalat }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm">
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-bold" style="background-color: #e0e7ff; color: #4648d4;">
                                        {{ $item->kategori->namakategori ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @php
                                        $stockConfig = [
                                            0 => ['bg' => '#fee2e2', 'text' => '#ef4444', 'label' => 'Habis'],
                                            1 => ['bg' => '#fef3c7', 'text' => '#f59e0b', 'label' => 'Low Stock'],
                                            2 => ['bg' => '#d1fae5', 'text' => '#10b981', 'label' => 'Tersedia'],
                                        ];
                                        $status = $item->qty == 0 ? 0 : ($item->qty < 5 ? 1 : 2);
                                        $config = $stockConfig[$status];
                                    @endphp
                                    <span class="stock-badge" style="background-color: {{ $config['bg'] }}; color: {{ $config['text'] }};">{{ $config['label'] }} ({{ $item->qty }})</span>
                                </td>
                                <td class="px-4 py-5 text-sm text-on-surface-variant">
                                    {{ Str::limit($item->spesifikasi, 50) }}
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('alat.show', $item) }}" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#e0e7ff'; this.style.color='#4648d4'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'">
                                            <span class="material-symbols-outlined text-lg">visibility</span>
                                        </a>
                                        <a href="{{ route('alat.edit', $item) }}" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#fef3c7'; this.style.color='#f59e0b'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('alat.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#fee2e2'; this.style.color='#ef4444'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'" onclick="return confirm('Yakin hapus {{ $item->namaalat }}?')">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div style="color: #9ca3af;">
                                        <span class="material-symbols-outlined text-5xl mx-auto block mb-4">inventory_2</span>
                                        <h3 class="text-lg font-bold font-headline" style="color: #191c1e;">Belum ada data alat</h3>
                                        <p class="mt-1">Mulai dengan <a href="{{ route('alat.create') }}" class="font-semibold" style="color: #4648d4;">menambahkan alat baru</a>.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 flex items-center justify-between" style="border-top: 1px solid #e5e7eb; background-color: rgba(15, 23, 42, 0.02);">
                <p class="text-sm font-medium" style="color: #9ca3af;">
                    Showing <span style="color: #191c1e; font-weight: bold;">{{ $alat->count() }}</span> of <span style="color: #191c1e; font-weight: bold;">{{ $alat->total() }}</span> records
                </p>
                <div class="flex gap-1">
                    {{ $alat->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

