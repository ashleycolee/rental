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
                <h2 class="text-4xl font-extrabold font-headline tracking-tight" style="color: #191c1e;">Laporan Peminjaman</h2>
                <p class="mt-1 font-medium" style="color: #9ca3af;">Pantau semua aktivitas peminjaman secara lengkap</p>
            </div>
        </div>

        <!-- Controls -->
        <div class="flex flex-col lg:flex-row gap-4 p-4 rounded-2xl" style="background-color: #f2f4f6;">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2" style="color: #9ca3af;">search</span>
                <form method="GET" action="{{ route('laporan.index') }}" class="w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama peminjam, barang, atau catatan..." class="w-full pl-12 pr-4 py-3 border-none rounded-xl text-sm font-medium" style="background-color: #ffffff; color: #191c1e;" onfocus="this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'" onblur="this.style.boxShadow='none'"/>
                </form>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('laporan.printAll') }}" class="p-3 text-slate-500 rounded-xl transition-colors hover:text-orange-600" style="background-color: #ffffff;" onmouseover="this.style.backgroundColor='#fff7ed'" onmouseout="this.style.backgroundColor='#ffffff'" title="Print Semua">
                    <span class="material-symbols-outlined">print</span>
                </a>
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
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Peminjam</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Barang</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Tgl Pinjam</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Qty</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider" style="color: #9ca3af;">Status</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-right" style="color: #9ca3af;">Aksi / ID</th>
                        </tr>
                    </thead>
                    <tbody style="border-top: 1px solid #e5e7eb;">
                        @forelse ($peminjaman as $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;" onmouseover="this.style.backgroundColor='rgba(15, 23, 42, 0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold" style="background-color: #e0e7ff; color: #4648d4;">
                                            {{ substr($item->user->username ?? 'User', 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold" style="color: #191c1e;">{{ $item->user->namalengkap ?? $item->user->username }}</p>
                                            <p class="text-xs" style="color: #9ca3af;">{{ $item->user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg" style="color: #9ca3af;">inventory_2</span>
                                        <span class="font-medium" style="color: #374151;">{{ $item->alat->namaalat }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-medium" style="color: #6b7280;">{{ $item->tglpinjam->format('d M Y') }}</td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #f0f9ff; color: #0369a1;">{{ $item->qty }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $statusConfig = [
                                            'menunggu' => ['bg' => '#fef3c7', 'text' => '#f59e0b', 'label' => 'Menunggu'],
                                            'disetujui' => ['bg' => '#d1fae5', 'text' => '#10b981', 'label' => 'Disetujui'],
                                            'dipinjam' => ['bg' => '#bfdbfe', 'text' => '#3b82f6', 'label' => 'Dipinjam'],
                                            'dikembalikan' => ['bg' => '#f3f4f6', 'text' => '#6b7280', 'label' => 'Dikembalikan'],
                                        ];
                                        $config = $statusConfig[$item->status] ?? $statusConfig['dikembalikan'];
                                    @endphp
                                    <span class="status-badge" style="background-color: {{ $config['bg'] }}; color: {{ $config['text'] }};">{{ $config['label'] }}</span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center gap-2 justify-end">
                                        <a href="{{ route('laporan.print', $item->idpinjam) }}" class="w-9 h-9 flex items-center justify-center rounded-lg transition-all text-green-600 hover:bg-green-50 hover:scale-105" title="Print Laporan">
                                            <span class="material-symbols-outlined text-lg">print</span>
                                        </a>
                                    </div>
                                    <div class="text-xs font-mono font-bold text-right mt-1" style="color: #6b7280;">#{{ $item->idpinjam }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div style="color: #9ca3af;">
                                        <span class="material-symbols-outlined text-5xl mx-auto block mb-4">description</span>
                                        <h3 class="text-lg font-bold font-headline" style="color: #191c1e;">Belum ada laporan</h3>
                                        <p class="mt-1">Data peminjaman akan muncul di sini.</p>
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
                    Showing <span style="color: #191c1e; font-weight: bold;">{{ $peminjaman->count() }}</span> of <span style="color: #191c1e; font-weight: bold;">{{ $peminjaman->total() }}</span> records
                </p>
                <div>
                    {{ $peminjaman->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

