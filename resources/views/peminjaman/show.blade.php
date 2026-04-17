<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Peminjaman {{ $peminjaman->idpinjam }} | Peminjaman App</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#ffdad6",
                        "secondary": "#8127cf",
                        "surface-variant": "#e0e3e5",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-container": "#007da9",
                        "on-error": "#ffffff",
                        "primary-fixed": "#e1e0ff",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "inverse-primary": "#c0c1ff",
                        "primary": "#4648d4",
                        "secondary-container": "#9c48ea",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#2c0051",
                        "tertiary-fixed": "#c4e7ff",
                        "outline-variant": "#c7c4d7",
                        "on-tertiary-fixed": "#001e2c",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-background": "#191c1e",
                        "error": "#ba1a1a",
                        "background": "#f7f9fb",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed": "#07006c",
                        "on-tertiary-fixed-variant": "#004c69",
                        "tertiary": "#006387",
                        "on-secondary-container": "#fffbff",
                        "on-tertiary-container": "#fcfcff",
                        "on-secondary-fixed-variant": "#6900b3",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-container": "#fffbff",
                        "secondary-fixed": "#f0dbff",
                        "surface-container-high": "#e6e8ea",
                        "surface-dim": "#d8dadc",
                        "outline": "#767586",
                        "surface-tint": "#494bd6",
                        "surface-bright": "#f7f9fb",
                        "on-error-container": "#93000a",
                        "on-surface": "#191c1e",
                        "surface-container": "#eceef0",
                        "primary-container": "#6063ee",
                        "tertiary-fixed-dim": "#7bd0ff",
                        "primary-fixed-dim": "#c0c1ff",
                        "on-surface-variant": "#464554",
                        "surface": "#f7f9fb",
                        "secondary-fixed-dim": "#ddb7ff"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "1.5rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                        label: ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        .glass-header {
            background: rgba(247, 249, 251, 0.7);
            backdrop-filter: blur(20px);
        }
        .kinetic-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background flex justify-center font-body text-on-surface">
    <!-- Include Sidebar for consistency -->
    <x-sidebar />
    
    <!-- Focused View Layout -->
    <div class="relative flex min-h-screen w-full flex-col  overflow-x-hidden ">
        <!-- Minimal Back Navigation -->
        <nav class="sticky top-0 z-50 glass-header border-b border-outline-variant/15 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('peminjaman.index') }}" class="flex items-center justify-center p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="font-headline text-headline-sm font-bold tracking-tight text-on-surface">Detail Peminjaman</h1>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex px-4 py-1.5 rounded-full bg-tertiary/10 text-tertiary text-label-md font-semibold" style="background-color: #fef3c7; color: #f59e0b;">
                    {{ ucfirst($peminjaman->status) }}
                </span>
            </div>
        </nav>
        <!-- Main Content Grid -->
        <main class="max-w-6xl mx-auto w-full p-6 md:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Peminjam & Alat Info -->
            <div class="lg:col-span-7 flex flex-col gap-8">
                <!-- Peminjam Profile Card -->
                <section class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                        <div class="relative">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center text-white shadow-md border-4 border-surface-container-high">
                                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">account_circle</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="font-headline text-2xl font-bold text-on-surface">{{ $peminjaman->user->namalengkap ?? $peminjaman->user->username }}</h2>
                            <div class="flex flex-wrap gap-x-4 gap-y-2 mt-1">
                                <span class="flex items-center gap-1 text-on-surface-variant text-sm">
                                    <span class="material-symbols-outlined text-primary text-sm" style="font-variation-settings: 'FILL' 1;">person</span>
                                    {{ $peminjaman->user->username }}
                                </span>
                                @if($peminjaman->user->nohp)
                                <span class="flex items-center gap-1 text-on-surface-variant text-sm">
                                    <span class="material-symbols-outlined text-sm">phone</span>
                                    {{ $peminjaman->user->nohp }}
                                </span>
                                @endif
                                @if($peminjaman->user->identitas)
                                <span class="flex items-center gap-1 text-on-surface-variant text-sm">
                                    <span class="material-symbols-outlined text-sm">badge</span>
                                    {{ $peminjaman->user->identitas }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Alat Detail -->
                <section class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm">
                    @if($peminjaman->alat->gambaralat)
                    <div class="w-full h-80 bg-cover bg-center object-cover" style="background-image: url('{{ Storage::url($peminjaman->alat->gambaralat) }}');"></div>
                    @else
                    <div class="w-full h-80 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-gray-400">inventory_2</span>
                    </div>
                    @endif
                    <div class="p-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-secondary font-semibold text-sm tracking-widest uppercase mb-1" style="color: #8127cf;">{{ $peminjaman->alat->kategori->namakategori ?? 'Umum' }}</p>
                                <h3 class="font-headline text-3xl font-bold text-on-surface">{{ $peminjaman->alat->namaalat }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="text-on-surface-variant text-sm" style="color: #9ca3af;">Quantity</p>
                                <p class="font-headline text-xl font-bold text-on-surface" style="color: #191c1e;">{{ $peminjaman->qty }}</p>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="p-4 bg-surface-container-high rounded-xl" style="background-color: #f8fafc;">
                                <p class="text-xs text-on-surface-variant mb-1" style="color: #9ca3af;">ID Alat</p>
                                <p class="font-mono font-bold text-sm" style="color: #191c1e;">{{ $peminjaman->alat->idalat }}</p>
                            </div>
                            <div class="p-4 bg-surface-container-high rounded-xl" style="background-color: #f8fafc;">
                                <p class="text-xs text-on-surface-variant mb-1" style="color: #9ca3af;">Stok Tersedia</p>
                                <p class="font-bold text-sm" style="color: #10b981;">{{ $peminjaman->alat->qty }} unit</p>
                            </div>
                            <div class="p-4 bg-surface-container-high rounded-xl" style="background-color: #f8fafc;">
                                <p class="text-xs text-on-surface-variant mb-1" style="color: #9ca3af;">Tanggal Pinjam</p>
                                <p class="font-bold text-sm" style="color: #191c1e;">{{ $peminjaman->tglpinjam->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="mt-8 border-t border-outline-variant/15 pt-6" style="border-color: #e5e7eb;">
                            <h4 class="font-headline font-bold text-on-surface mb-2" style="color: #191c1e;">Spesifikasi</h4>
                            <p class="text-on-surface-variant leading-relaxed" style="color: #6b7280;">
                                {{ $peminjaman->alat->spesifikasi ?: 'Tidak ada spesifikasi tambahan.' }}
                            </p>
                        </div>
                    </div>
                </section>
                <!-- Catatan Section -->
                @if($peminjaman->catatan || $peminjaman->kondisiakhir)
                <section class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-headline text-xl font-bold text-on-surface" style="color: #191c1e;">Catatan Peminjaman</h3>
                    </div>
                    <div class="space-y-4">
                        @if($peminjaman->catatan)
                        <div class="flex gap-4 p-4 rounded-xl bg-primary/5" style="background-color: #eef2ff;">
                            <span class="material-symbols-outlined text-primary" style="color: #4648d4;">sticky_note_2</span>
                            <div>
                                <p class="text-on-surface-variant text-sm leading-relaxed" style="color: #6b7280;">
                                    {{ $peminjaman->catatan }}
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($peminjaman->kondisiakhir)
                        <div class="flex gap-4 p-4 rounded-xl bg-orange/5" style="background-color: #fff7ed;">
                            <span class="material-symbols-outlined text-orange" style="color: #f59e0b;">note_alt</span>
                            <div>
                                <p class="text-orange text-sm leading-relaxed font-medium" style="color: #d97706;">
                                    {{ $peminjaman->kondisiakhir }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
            </div>
            <!-- Right Column: Timeline & Actions -->
            <div class="lg:col-span-5 flex flex-col gap-8">
                <!-- Status Timeline -->
                <section class="bg-surface-container-lowest rounded-xl p-8 shadow-sm sticky top-28">
                    <h3 class="font-headline text-xl font-bold text-on-surface mb-8" style="color: #191c1e;">Alur Proses Peminjaman</h3>
                    <?php
                        $timelineSteps = [
                            [
                                'id' => 'menunggu',
                                'label' => 'Menunggu Persetujuan',
                                'icon' => 'hourglass_empty',
                                'color' => '#fef3c7',
                                'iconColor' => '#f59e0b',
                                'timestamp' => $peminjaman->created_at
                            ],
                            [
                                'id' => 'disetujui',
                                'label' => 'Disetujui',
                                'icon' => 'check_circle',
                                'color' => '#d1fae5',
                                'iconColor' => '#10b981',
                                'timestamp' => $peminjaman->updated_at
                            ],
                            [
                                'id' => 'dipinjam',
                                'label' => 'Sedang Dipinjam',
                                'icon' => 'local_shipping',
                                'color' => '#bfdbfe',
                                'iconColor' => '#3b82f6',
                                'timestamp' => $peminjaman->updated_at
                            ],
                            [
                                'id' => 'dikembalikan',
                                'label' => 'Dikembalikan',
                                'icon' => 'assignment_return',
                                'color' => '#f3f4f6',
                                'iconColor' => '#6b7280',
                                'timestamp' => $peminjaman->updated_at
                            ]
                        ];

                        $statusOrder = ['menunggu' => 0, 'disetujui' => 1, 'dipinjam' => 2, 'dikembalikan' => 3];
                        $currentIndex = $statusOrder[$peminjaman->status] ?? 0;
                    ?>
                    <div class="relative">
                        <!-- Progressive vertical line: green to current color to gray -->
                        <div class="absolute left-[15px] top-2 bottom-2 w-0.5 bg-gradient-to-b bg-clip-padding from-[#10b981] via-transparent to-[#e5e7eb] z-0" style="background: linear-gradient(to bottom, #10b981 0%, #10b981 <?= $currentIndex * 25 ?>%, transparent <?= $currentIndex * 25 ?>%, #e5e7eb 100%);"></div>
                        <div class="space-y-8">
                            @foreach($timelineSteps as $index => $step)
                                @php
                                    $state = ($index < $currentIndex) ? 'completed' : (($index == $currentIndex) ? 'active' : 'upcoming');
                                    $bgColor = $state === 'completed' ? '#10b981' : ($state === 'active' ? $step['color'] : 'transparent');
                                    $iconFill = $state === 'completed' ? 'check' : $step['icon'];
                                    $iconColor = $state === 'completed' ? '#ffffff' : ($state === 'active' ? $step['iconColor'] : '#9ca3af');
                                    $textColor = $state === 'active' ? $step['iconColor'] : '#191c1e';
                                    $pulse = $state === 'active' ? 'animate-pulse ring-4 ring-'.$step['color'].' ring-opacity-30' : '';
                                @endphp
                                <div class="relative flex gap-6 items-start">
                                    <div class="z-10 w-10 h-10 rounded-full flex items-center justify-center ring-4 ring-background shrink-0 {{ $pulse }}" style="background-color: {{ $bgColor }} !important;">
                                        <span class="material-symbols-outlined text-lg {{ $state === 'upcoming' ? 'text-outline-variant' : '' }}" style="color: {{ $iconColor }}; font-variation-settings: 'FILL' {{ $state === 'completed' || $state === 'active' ? '1' : '0' }} !important;">{{ $iconFill }}</span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1">
                                        <p class="font-bold {{ $state !== 'upcoming' ? 'text-on-surface' : 'text-on-surface-variant' }}" style="color: {{ $textColor }} !important;">
                                            {{ $step['label'] }}
                                            @if($state === 'active')
                                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-bold bg-{{ $step['color'] === '#fef3c7' ? 'yellow' : ($step['color'] === '#d1fae5' ? 'green' : ($step['color'] === '#bfdbfe' ? 'blue' : 'gray')) }}-100 text-{{ $step['color'] === '#fef3c7' ? 'yellow' : ($step['color'] === '#d1fae5' ? 'green' : ($step['color'] === '#bfdbfe' ? 'blue' : 'gray')) }}-800">Saat Ini</span>
                                            @endif
                                        </p>
                                        @if($step['timestamp'])
                                            <p class="text-on-surface-variant text-sm" style="color: #6b7280;">
                                                {{ $step['timestamp']->format('d M Y H:i') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- Actions -->
                <section class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="space-y-3">
                        @if(Auth::user()->role === 'petugas' && $peminjaman->status === 'menunggu')
                            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}" class="inline w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="w-full kinetic-gradient text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:opacity-90 transition-all flex items-center justify-center gap-2" style="background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);" onclick="return confirm('Setujui peminjaman? Stok akan berkurang.')" >
                                    <span class="material-symbols-outlined">check_circle</span>
                                    Setujui Peminjaman
                                </button>
                            </form>
                        @endif
                        @if(Auth::user()->role === 'petugas' && in_array($peminjaman->status, ['disetujui']))
                            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}" class="inline w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="dipinjam">
                                <button type="submit" class="w-full bg-surface-container-high text-on-surface py-4 rounded-xl font-bold text-lg hover:bg-surface-container-highest transition-all flex items-center justify-center gap-2" onclick="return confirm('Konfirmasi dikembalikan? Stok akan ditambah kembali.')" >
                                    <span class="material-symbols-outlined">assignment_return</span>
                                    Konfirmasi Dipinjam
                                </button>
                            </form>
                        @endif
                        @if(Auth::user()->role === 'petugas' && in_array($peminjaman->status, ['dipinjam']))
                            <form method="POST" action="{{ route('peminjaman.update', $peminjaman) }}" class="inline w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="dikembalikan">
                                <button type="submit" class="w-full bg-surface-container-high text-on-surface py-4 rounded-xl font-bold text-lg hover:bg-surface-container-highest transition-all flex items-center justify-center gap-2" onclick="return confirm('Konfirmasi dikembalikan? Stok akan ditambah kembali.')" >
                                    <span class="material-symbols-outlined">assignment_return</span>
                                    Konfirmasi Dikembalikan
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('peminjaman.index') }}" class="w-full bg-gray-100 text-gray-900 py-4 rounded-xl font-bold text-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Kembali ke Daftar
                        </a>
                        @if(Auth::user()->role === 'petugas')
                            <form method="POST" action="{{ route('peminjaman.destroy', $peminjaman) }}" class="inline w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-100 text-red-900 mt-2 py-4 rounded-xl font-bold text-lg hover:bg-red-200 transition-all flex items-center justify-center gap-2" onclick="return confirm('Hapus peminjaman ini?')" >
                                    <span class="material-symbols-outlined">delete</span>
                                    Hapus Peminjaman
                                </button>
                            </form>
                        @endif
                    </div>
                </section>
            </div>
        </main>
        <!-- Subtle Footer -->
        <footer class="mt-auto py-8 text-center text-on-surface-variant text-xs" style="color: #9ca3af;">
            Peminjaman App © 2024 • Sistem Manajemen Peminjaman
        </footer>
    </div>
</body>
</html>

