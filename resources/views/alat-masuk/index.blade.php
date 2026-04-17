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
                <h2 class="text-4xl font-extrabold font-headline tracking-tight" style="color: #191c1e;">Alat Masuk</h2>
                <p class="mt-1 font-medium" style="color: #9ca3af;">Riwayat tambah stok alat inventaris</p>
            </div>
            <a href="{{ route('alat-masuk.create') }}" class="px-8 py-3.5 text-white rounded-xl font-bold hover:scale-105 hover:opacity-95 transition-all" style="background: linear-gradient(to bottom right, #4648d4, #8127cf); box-shadow: 0 8px 20px -4px rgba(70, 72, 212, 0.3);">
                + Tambah Stok
            </a>
        </div>

        <!-- Summary Section (Bento Style) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total Masuk Hari Ini -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(16, 185, 129, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Hari Ini</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #10b981;">{{ $alatMasuk->where('tglmasuk', today())->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #d1fae5; color: #10b981;">
                        <span class="material-symbols-outlined text-3xl">today</span>
                    </div>
                </div>
            </div>

            <!-- Total Minggu Ini -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(245, 158, 11, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Minggu Ini</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #f59e0b;">{{ $alatMasuk->filter(fn($item) => $item->tglmasuk->isCurrentWeek())->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #fef3c7; color: #f59e0b;">
                        <span class="material-symbols-outlined text-3xl">date_range</span>
                    </div>
                </div>
            </div>

            <!-- Total Bulan Ini -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(59, 130, 246, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Bulan Ini</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #3b82f6;">{{ $alatMasuk->filter(fn($item) => $item->tglmasuk->isCurrentMonth())->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #bfdbfe; color: #3b82f6;">
                        <span class="material-symbols-outlined text-3xl">calendar_month</span>
                    </div>
                </div>
            </div>

            <!-- Total Unit Ditambah -->
            <div class="p-6 rounded-3xl overflow-hidden relative group" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(to bottom right, rgba(70, 72, 212, 0.05), transparent);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest mb-1" style="color: #9ca3af;">Total Unit</p>
                        <h3 class="text-3xl font-black font-headline" style="color: #4648d4;">{{ $alatMasuk->sum('qty') }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #e0e7ff; color: #4648d4;">
                        <span class="material-symbols-outlined text-3xl">add_circle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="flex flex-col lg:flex-row gap-4 p-4 rounded-2xl" style="background-color: #f2f4f6;">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2" style="color: #9ca3af;">search</span>
                <form method="GET" action="{{ route('alat-masuk.index') }}" class="w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alat..." class="w-full pl-12 pr-4 py-3 border-none rounded-xl text-sm font-medium" style="background-color: #ffffff; color: #191c1e;" onfocus="this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'" onblur="this.style.boxShadow='none'"/>
                </form>
            </div>
            <div class="flex flex-wrap gap-3">
                <select class="px-4 py-3 border-none rounded-xl text-sm font-medium min-w-[140px]" style="background-color: #ffffff; color: #191c1e;" onfocus="this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'" onblur="this.style.boxShadow='none'">
                    <option value="">Semua Periode</option>
                    <option value="hari">Hari Ini</option>
                    <option value="minggu">Minggu Ini</option>
                    <option value="bulan">Bulan Ini</option>
                </select>
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
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">ID</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Alat</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-center" style="color: #9ca3af;">Qty</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Tanggal</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-right" style="color: #9ca3af;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="border-top: 1px solid #e5e7eb;">
                        @forelse ($alatMasuk as $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;" onmouseover="this.style.backgroundColor='rgba(15, 23, 42, 0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-5">
                                    <div>
                                        <p class="font-bold" style="color: #191c1e;">#{{ $item->idmasuk }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold" style="background-color: #e0e7ff; color: #4648d4;">
                                            {{ substr($item->alat->namaalat, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-medium" style="color: #191c1e;">{{ $item->alat->namaalat }}</p>
                                            <p class="text-xs" style="color: #9ca3af;">{{ $item->alat->kategori->namakategori }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="status-badge" style="background-color: #d1fae5; color: #10b981;">+{{ $item->qty }}</span>
                                </td>
                                <td class="px-6 py-5 font-medium" style="color: #6b7280;">{{ $item->tglmasuk->format('d M Y') }}</td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('alat-masuk.show', $item) }}" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#e0e7ff'; this.style.color='#4648d4'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'">
                                            <span class="material-symbols-outlined text-lg">visibility</span>
                                        </a>
                                        <a href="{{ route('alat-masuk.edit', $item) }}" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#fef3c7'; this.style.color='#f59e0b'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('alat-masuk.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all" style="color: #9ca3af;" onmouseover="this.style.backgroundColor='#fee2e2'; this.style.color='#ef4444'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#9ca3af'" onclick="return confirm('Yakin hapus? Stok akan dikurangi.')" title="Hapus">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div style="color: #9ca3af;">
                                        <span class="material-symbols-outlined text-5xl mx-auto block mb-4">add_circle</span>
                                        <h3 class="text-lg font-bold font-headline" style="color: #191c1e;">Belum ada data alat masuk</h3>
                                        <p class="mt-1">Mulai dengan <a href="{{ route('alat-masuk.create') }}" class="font-semibold" style="color: #4648d4;">menambah stok alat</a>.</p>
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
                    Showing <span style="color: #191c1e; font-weight: bold;">{{ $alatMasuk->count() }}</span> of <span style="color: #191c1e; font-weight: bold;">{{ $alatMasuk->total() }}</span> records
                </p>
                <div class="flex gap-1">
                    {{ $alatMasuk->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

