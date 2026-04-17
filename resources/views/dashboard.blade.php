<x-app-layout>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        .main-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
        }
    </style>

    <div class="p-8 space-y-8" style="background-color: #f7f9fb; min-height: 100vh;">
        <!-- Fluid Background Elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] opacity-30 rounded-full blur-[120px] -z-10" style="background: radial-gradient(circle, #4648d4, transparent);"></div>
        <div class="absolute bottom-[5%] left-[5%] w-[300px] h-[300px] opacity-30 rounded-full blur-[100px] -z-10" style="background: radial-gradient(circle, #8127cf, transparent);"></div>

        <!-- Welcome Section -->
        <section>
            <h2 class="text-3xl font-extrabold font-headline tracking-tight mb-2" style="color: #191c1e;">Welcome back, Admin</h2>
            <p class="max-w-2xl leading-relaxed" style="color: #464554;">Everything in the ecosystem is running smoothly. There are <span class="font-bold" style="color: #4648d4;">{{ \App\Models\Peminjaman::where('status', 'menunggu')->count() }} pending approvals</span> that require your attention today.</p>
        </section>

        <!-- Statistic Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Alat -->
            <div class="glass-card rounded-[1.5rem] p-6 shadow-sm relative overflow-hidden group" style="background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(224, 227, 229, 0.5);">
                <div class="absolute -right-2 -top-2 p-4 rounded-full group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(70, 72, 212, 0.05);">
                    <span class="material-symbols-outlined text-4xl" style="color: rgba(70, 72, 212, 0.2);">inventory_2</span>
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #9ca3af;">Total Barang</p>
                <h3 class="text-3xl font-extrabold font-headline" style="color: #191c1e;">{{ \App\Models\Alat::count() }}</h3>
                <div class="mt-4 flex items-center gap-2 text-xs font-bold" style="color: #006387;">
                    <span class="material-symbols-outlined text-sm">trending_up</span>
                    <span>Update realtime</span>
                </div>
            </div>

            <!-- Barang Dipinjam -->
            <div class="glass-card rounded-[1.5rem] p-6 shadow-sm relative overflow-hidden group" style="background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(224, 227, 229, 0.5);">
                <div class="absolute -right-2 -top-2 p-4 rounded-full group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(129, 39, 207, 0.05);">
                    <span class="material-symbols-outlined text-4xl" style="color: rgba(129, 39, 207, 0.2);">handshake</span>
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #9ca3af;">Barang Dipinjam</p>
                <h3 class="text-3xl font-extrabold font-headline" style="color: #191c1e;">{{ \App\Models\Peminjaman::where('status', 'dipinjam')->count() }}</h3>
                <div class="mt-4 flex items-center gap-2 text-xs font-bold" style="color: #8127cf;">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    <span>{{ \App\Models\Peminjaman::where('status', 'menunggu')->count() }} items pending</span>
                </div>
            </div>

            <!-- Barang Tersedia -->
            <div class="glass-card rounded-[1.5rem] p-6 shadow-sm relative overflow-hidden group" style="background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(224, 227, 229, 0.5);">
                <div class="absolute -right-2 -top-2 p-4 rounded-full group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(0, 99, 135, 0.05);">
                    <span class="material-symbols-outlined text-4xl" style="color: rgba(0, 99, 135, 0.2);">check_circle</span>
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #9ca3af;">Barang Tersedia</p>
                <h3 class="text-3xl font-extrabold font-headline" style="color: #191c1e;">{{ \App\Models\Alat::count() - \App\Models\Peminjaman::where('status', 'dipinjam')->count() }}</h3>
                <div class="mt-4 flex items-center gap-2 text-xs font-bold" style="color: #006387;">
                    <span class="material-symbols-outlined text-sm">inventory</span>
                    <span>{{ round((((\App\Models\Alat::count() - \App\Models\Peminjaman::where('status', 'dipinjam')->count()) / \App\Models\Alat::count()) * 100), 0) }}% Available</span>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="glass-card rounded-[1.5rem] p-6 shadow-sm relative overflow-hidden group" style="background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(224, 227, 229, 0.5);">
                <div class="absolute -right-2 -top-2 p-4 rounded-full group-hover:scale-110 transition-transform duration-300" style="background-color: rgba(70, 72, 212, 0.05);">
                    <span class="material-symbols-outlined text-4xl" style="color: rgba(70, 72, 212, 0.2);">category</span>
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #9ca3af;">Kategori</p>
                <h3 class="text-3xl font-extrabold font-headline" style="color: #191c1e;">{{ \App\Models\Kategori::count() }}</h3>
                <div class="mt-4 flex items-center gap-2 text-xs font-bold" style="color: #4648d4;">
                    <span class="material-symbols-outlined text-sm">verified_user</span>
                    <span>All Active</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions + Recent Activity -->
        <div class="grid grid-cols-12 gap-8">
            <!-- Quick Actions -->
            <div class="col-span-12 lg:col-span-3 space-y-4">
                <h4 class="text-sm font-bold uppercase tracking-wider mb-4 px-1" style="color: #9ca3af;">Quick Actions</h4>
                
                <!-- Action Button 1 -->
                <a href="{{ route('alat.create') }}" class="w-full group p-4 rounded-2xl shadow-sm flex items-center gap-4 transition-all duration-300 text-left hover:shadow-md" style="background-color: #ffffff; border: 1px solid rgba(224, 227, 229, 0.5);" onmouseover="this.style.background='linear-gradient(135deg, #4648d4 0%, #8127cf 100%)'; this.style.color='white'" onmouseout="this.style.background='#ffffff'; this.style.color='inherit'">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors" style="background-color: #e0e7ff; color: #4648d4;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'; this.style.color='white'" onmouseout="this.style.backgroundColor='#e0e7ff'; this.style.color='#4648d4'">
                        <span class="material-symbols-outlined">add_box</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Tambah Barang</p>
                        <p class="text-xs" style="color: #9ca3af; opacity: 0.8;">Add new asset</p>
                    </div>
                </a>

                <!-- Action Button 2 -->
                <a href="{{ route('peminjaman.index') }}" class="w-full group p-4 rounded-2xl shadow-sm flex items-center gap-4 transition-all duration-300 text-left hover:shadow-md" style="background-color: #ffffff; border: 1px solid rgba(224, 227, 229, 0.5);" onmouseover="this.style.background='linear-gradient(135deg, #4648d4 0%, #8127cf 100%)'; this.style.color='white'" onmouseout="this.style.background='#ffffff'; this.style.color='inherit'">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors" style="background-color: #e0e7ff; color: #4648d4;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'; this.style.color='white'" onmouseout="this.style.backgroundColor='#e0e7ff'; this.style.color='#4648d4'">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Review Peminjaman</p>
                        <p class="text-xs" style="color: #9ca3af; opacity: 0.8;">Check {{ \App\Models\Peminjaman::where('status', 'menunggu')->count() }} requests</p>
                    </div>
                </a>

                <!-- Action Button 3 -->
                <a href="{{ route('kategori.create') }}" class="w-full group p-4 rounded-2xl shadow-sm flex items-center gap-4 transition-all duration-300 text-left hover:shadow-md" style="background-color: #ffffff; border: 1px solid rgba(224, 227, 229, 0.5);" onmouseover="this.style.background='linear-gradient(135deg, #4648d4 0%, #8127cf 100%)'; this.style.color='white'" onmouseout="this.style.background='#ffffff'; this.style.color='inherit'">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors" style="background-color: #e0e7ff; color: #4648d4;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'; this.style.color='white'" onmouseout="this.style.backgroundColor='#e0e7ff'; this.style.color='#4648d4'">
                        <span class="material-symbols-outlined">category</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Tambah Kategori</p>
                        <p class="text-xs" style="color: #9ca3af; opacity: 0.8;">Create new category</p>
                    </div>
                </a>

                <!-- Info Card -->
                <div class="mt-6 p-6 rounded-3xl text-white relative overflow-hidden" style="background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);">
                    <div class="relative z-10">
                        <h5 class="font-bold text-lg mb-2 leading-tight">Sistem Operasional</h5>
                        <p class="text-xs mb-4 opacity-80">Semua sistem berjalan normal dan siap melayani.</p>
                        <a href="#" class="text-xs font-bold px-4 py-2 rounded-full" style="background-color: white; color: #4648d4;">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="col-span-12 lg:col-span-9">
                <div class="glass-card rounded-[2rem] p-8 shadow-sm" style="background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(224, 227, 229, 0.5);">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold font-headline" style="color: #191c1e;">Recent Activity</h4>
                        <a class="text-xs font-bold hover:underline underline-offset-4" style="color: #4648d4;" href="{{ route('peminjaman.index') }}">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        @if($recentActivities->count() > 0)
                            <table class="w-full text-left">
                                <thead>
                                    <tr style="border-bottom: 1px solid rgba(224, 227, 229, 0.5);">
                                        <th class="pb-4 text-[10px] font-bold uppercase tracking-widest" style="color: #9ca3af;">Alat</th>
                                        <th class="pb-4 text-[10px] font-bold uppercase tracking-widest" style="color: #9ca3af;">User</th>
                                        <th class="pb-4 text-[10px] font-bold uppercase tracking-widest" style="color: #9ca3af;">Qty</th>
                                        <th class="pb-4 text-[10px] font-bold uppercase tracking-widest" style="color: #9ca3af;">Tanggal Pinjam</th>
                                        <th class="pb-4 text-[10px] font-bold uppercase tracking-widest" style="color: #9ca3af;">Status</th>
                                    </tr>
                                </thead>
                                <tbody style="border-top: 1px solid rgba(224, 227, 229, 0.5);">
                                    @foreach($recentActivities as $activity)
                                        <tr class="transition-all" style="border-bottom: 1px solid rgba(224, 227, 229, 0.3);" onmouseover="this.style.backgroundColor='rgba(15, 23, 42, 0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                                            <td class="py-4">
                                                <p class="text-sm font-medium" style="color: #374151;">{{ $activity->alat->namaalat }}</p>
                                                <p class="text-[10px]" style="color: #9ca3af;">{{ $activity->alat->kategori->namakategori }}</p>
                                            </td>
                                            <td class="py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white" style="background-color: #4648d4;">
                                                        {{ substr($activity->user->username ?? $activity->user->namalengkap, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-bold" style="color: #191c1e;">{{ $activity->user->username ?? $activity->user->namalengkap }}</p>
                                                        <p class="text-[10px]" style="color: #9ca3af;">#{{ $activity->user->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4">
                                                <p class="text-sm" style="color: #6b7280;">{{ $activity->qty }}</p>
                                            </td>
                                            <td class="py-4">
                                                <p class="text-sm" style="color: #6b7280;">{{ $activity->tglpinjam->format('d M Y') }}</p>
                                            </td>
                                            <td class="py-4">
                                                @php
                                                    $statusConfig = [
                                                        'menunggu' => ['bg' => '#fef3c7', 'text' => '#f59e0b', 'label' => 'Menunggu'],
                                                        'disetujui' => ['bg' => '#bfdbfe', 'text' => '#3b82f6', 'label' => 'Disetujui'],
                                                        'dipinjam' => ['bg' => '#d1fae5', 'text' => '#10b981', 'label' => 'Dipinjam'],
                                                        'dikembalikan' => ['bg' => '#f3f4f6', 'text' => '#6b7280', 'label' => 'Dikembalikan'],
                                                    ];
                                                    $config = $statusConfig[$activity->status] ?? $statusConfig['dikembalikan'];
                                                @endphp
                                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold" style="background-color: {{ $config['bg'] }}; color: {{ $config['text'] }};">
                                                    {{ $config['label'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="py-12 text-center">
                                <span class="material-symbols-outlined text-5xl mb-4 mx-auto block" style="color: #9ca3af;">folder_open</span>
                                <p style="color: #9ca3af;">Belum ada aktivitas</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
