<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>The Fluid Exchange - Item Borrowing System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary": "#ffffff",
                        "secondary-fixed-dim": "#ddb7ff",
                        "primary": "#4648d4",
                        "surface-container-high": "#e6e8ea",
                        "secondary": "#8127cf",
                        "tertiary-fixed": "#c4e7ff",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "tertiary-container": "#007da9",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed": "#001e2c",
                        "on-secondary-container": "#fffbff",
                        "background": "#f7f9fb",
                        "tertiary-fixed-dim": "#7bd0ff",
                        "inverse-primary": "#c0c1ff",
                        "on-primary-container": "#fffbff",
                        "surface-container": "#eceef0",
                        "outline": "#767586",
                        "surface-container-highest": "#e0e3e5",
                        "inverse-on-surface": "#eff1f3",
                        "surface-bright": "#f7f9fb",
                        "secondary-fixed": "#f0dbff",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-surface": "#191c1e",
                        "primary-fixed-dim": "#c0c1ff",
                        "outline-variant": "#c7c4d7",
                        "secondary-container": "#9c48ea",
                        "surface-variant": "#e0e3e5",
                        "primary-fixed": "#e1e0ff",
                        "on-secondary-fixed": "#2c0051",
                        "on-primary-fixed": "#07006c",
                        "on-background": "#191c1e",
                        "surface": "#f7f9fb",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "primary-container": "#6063ee",
                        "surface-dim": "#d8dadc",
                        "tertiary": "#006387",
                        "on-tertiary-container": "#fcfcff",
                        "inverse-surface": "#2d3133",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "on-tertiary-fixed-variant": "#004c69",
                        "on-surface-variant": "#464554",
                        "surface-tint": "#494bd6",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#6900b3"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .bg-primary-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
        }
        .text-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary-fixed selection:text-on-primary-fixed antialiased">

    <!-- Header / Navbar -->
    <header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl shadow-[0_12px_32px_-4px_rgba(70,72,212,0.04)]">
        <nav class="max-w-7xl mx-auto px-8 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent font-headline">
                The Fluid Exchange
            </div>
            <div class="hidden md:flex items-center gap-10 font-headline font-semibold tracking-tight">
                <a class="text-indigo-600 border-b-2 border-indigo-500/30 pb-1 hover:scale-105 transition-all duration-200" href="#">Beranda</a>
                <a class="text-slate-600 hover:text-indigo-500 hover:scale-105 transition-all duration-200" href="#feature">Fitur</a>
                <a class="text-slate-600 hover:text-indigo-500 hover:scale-105 transition-all duration-200" href="#about">Tentang Kami</a>
                <a class="text-slate-600 hover:text-indigo-500 hover:scale-105 transition-all duration-200" href="#contact">Kontak</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 text-slate-600 font-semibold hover:text-indigo-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 text-slate-600 font-semibold hover:text-indigo-600 transition-colors">Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="relative pt-32 overflow-hidden">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-8 pb-24 flex flex-col md:flex-row items-center gap-16">
            <div class="flex-1 space-y-8 text-center md:text-left">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed text-xs font-bold uppercase tracking-widest">
                    Digital Curator Platform
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold font-headline leading-[1.1] text-on-surface">
                    Sistem Peminjaman Barang yang <span class="text-gradient">Cepat &amp; Efisien</span>
                </h1>
                <p class="text-lg text-on-surface-variant max-w-xl leading-relaxed">
                    Kelola inventaris dan pertukaran aset perusahaan Anda dengan platform berbasis kurasi digital yang memprioritaskan kemudahan dan transparansi.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center md:justify-start">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-primary-gradient text-white rounded-xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all duration-200 text-center">
                            Mulai Sekarang
                        </a>
                    @endif
                    <button class="px-8 py-4 glass-panel border border-outline-variant/30 text-on-surface rounded-xl font-bold text-lg hover:bg-surface-container-high transition-all duration-200">
                        Lihat Demo
                    </button>
                </div>
            </div>
            <div class="flex-1 relative w-full aspect-square md:aspect-auto">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="relative glass-panel rounded-xl border border-outline-variant/30 shadow-2xl overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img
                        alt="Dashboard Mockup"
                        class="w-[1080px] h-[540px] object-cover"
                        src="https://img.jakpost.net/c/2018/01/29/2018_01_29_39564_1517188935._large.jpg"
                    />
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="feature bg-surface-container-low py-24 px-8" id="feature">
            <div class="max-w-7xl mx-auto">
                <div class="mb-16 text-center md:text-left">
                    <h2 class="text-4xl font-extrabold font-headline mb-4">Fitur Unggulan</h2>
                    <div class="h-1.5 w-24 bg-primary-gradient rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="group p-8 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-transparent hover:border-primary/10">
                        <div class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary-gradient group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-3xl">rocket_launch</span>
                        </div>
                        <h3 class="text-xl font-bold font-headline mb-4">Sistem Pinjam Mudah</h3>
                        <p class="text-on-surface-variant leading-relaxed">Alur peminjaman yang intuitif hanya dengan beberapa klik tanpa ribet administrasi manual.</p>
                    </div>
                    <div class="group p-8 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-transparent hover:border-primary/10">
                        <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary-gradient group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-3xl">location_on</span>
                        </div>
                        <h3 class="text-xl font-bold font-headline mb-4">Tracking Real-time</h3>
                        <p class="text-on-surface-variant leading-relaxed">Pantau lokasi dan status barang Anda secara langsung kapan saja dan di mana saja.</p>
                    </div>
                    <div class="group p-8 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-transparent hover:border-primary/10">
                        <div class="w-14 h-14 bg-tertiary-container/10 text-tertiary rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary-gradient group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-3xl">shield_person</span>
                        </div>
                        <h3 class="text-xl font-bold font-headline mb-4">Role-based Access</h3>
                        <p class="text-on-surface-variant leading-relaxed">Kendali akses penuh berdasarkan level pengguna untuk keamanan data inventaris Anda.</p>
                    </div>
                    <div class="group p-8 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-transparent hover:border-primary/10">
                        <div class="w-14 h-14 bg-error-container/10 text-error rounded-xl flex items-center justify-center mb-8 group-hover:bg-primary-gradient group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-3xl">notifications_active</span>
                        </div>
                        <h3 class="text-xl font-bold font-headline mb-4">Sistem Notifikasi</h3>
                        <p class="text-on-surface-variant leading-relaxed">Dapatkan pengingat otomatis untuk pengembalian dan persetujuan peminjaman baru.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-24 px-8 overflow-hidden about" id="about">
            <div class="max-w-7xl mx-auto text-center mb-20">
                <h2 class="text-4xl font-extrabold font-headline">Bagaimana Ini Bekerja</h2>
            </div>
            <div class="max-w-5xl mx-auto relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-outline-variant/30 -translate-y-1/2"></div>
                <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="relative bg-background group text-center">
                        <div class="w-16 h-16 bg-primary-gradient text-white rounded-full flex items-center justify-center mx-auto mb-6 relative z-10 shadow-lg font-bold text-2xl">1</div>
                        <h3 class="text-xl font-bold mb-2">Daftar</h3>
                        <p class="text-on-surface-variant">Buat akun perusahaan atau organisasi Anda dalam hitungan menit.</p>
                    </div>
                    <div class="relative bg-background group text-center">
                        <div class="w-16 h-16 bg-primary-gradient text-white rounded-full flex items-center justify-center mx-auto mb-6 relative z-10 shadow-lg font-bold text-2xl">2</div>
                        <h3 class="text-xl font-bold mb-2">Ajukan</h3>
                        <p class="text-on-surface-variant">Pilih barang yang dibutuhkan dan ajukan permohonan peminjaman.</p>
                    </div>
                    <div class="relative bg-background group text-center">
                        <div class="w-16 h-16 bg-primary-gradient text-white rounded-full flex items-center justify-center mx-auto mb-6 relative z-10 shadow-lg font-bold text-2xl">3</div>
                        <h3 class="text-xl font-bold mb-2">Pantau</h3>
                        <p class="text-on-surface-variant">Pantau status persetujuan dan riwayat peminjaman secara transparan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Data Management Section -->
        <section class="py-24 bg-surface-container-low px-8">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-20">
                <div class="flex-1 order-2 lg:order-1">
                    <div class="glass-panel rounded-xl p-6 border border-outline-variant/20 shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-outline-variant/30 text-xs font-bold text-on-surface-variant uppercase tracking-wider">
                                        <th class="pb-4">Nama Barang</th>
                                        <th class="pb-4">Peminjam</th>
                                        <th class="pb-4">Status</th>
                                        <th class="pb-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr class="border-b border-outline-variant/10">
                                        <td class="py-4 font-bold">MacBook Pro M2</td>
                                        <td class="py-4">Robby Kurnia</td>
                                        <td class="py-4"><span class="px-3 py-1 bg-tertiary/10 text-tertiary rounded-full text-xs font-bold">Tersedia</span></td>
                                        <td class="py-4 text-primary font-bold cursor-pointer">Detail</td>
                                    </tr>
                                    <tr class="border-b border-outline-variant/10">
                                        <td class="py-4 font-bold">Sony A7 IV</td>
                                        <td class="py-4">Sarah Jane</td>
                                        <td class="py-4"><span class="px-3 py-1 bg-error-container text-error rounded-full text-xs font-bold">Dipinjam</span></td>
                                        <td class="py-4 text-primary font-bold cursor-pointer">Detail</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 font-bold">DJI Mavic 3</td>
                                        <td class="py-4">Andi Prasetyo</td>
                                        <td class="py-4"><span class="px-3 py-1 bg-tertiary/10 text-tertiary rounded-full text-xs font-bold">Tersedia</span></td>
                                        <td class="py-4 text-primary font-bold cursor-pointer">Detail</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex-1 order-1 lg:order-2 space-y-8">
                    <h2 class="text-4xl font-extrabold font-headline leading-tight">Manajemen Data yang Jelas</h2>
                    <p class="text-lg text-on-surface-variant leading-relaxed">
                        Interface kami dirancang untuk memudahkan administrator dalam melihat gambaran besar inventaris tanpa kebingungan. Visualisasi data yang bersih membantu pengambilan keputusan yang lebih cepat.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            <span class="font-medium">Filter cerdas berdasarkan kategori</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            <span class="font-medium">Laporan inventaris otomatis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            <span class="font-medium">Audit trail setiap transaksi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-7xl mx-auto px-8 py-32">
            <div class="relative bg-primary-gradient rounded-xl p-12 md:p-20 overflow-hidden text-center text-white">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-black/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
                <div class="relative z-10 max-w-2xl mx-auto space-y-8">
                    <h2 class="text-4xl md:text-5xl font-extrabold font-headline">Mulai Kelola Peminjaman Lebih Mudah</h2>
                    <p class="text-xl text-white/80">Bergabunglah dengan ratusan tim yang telah mendigitalisasi proses peminjaman mereka bersama The Fluid Exchange.</p>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-white text-primary rounded-xl font-bold text-xl shadow-2xl hover:scale-105 active:scale-95 transition-all duration-200">
                            Daftar Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 py-12 px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-12">
            <div class="space-y-4">
                <div class="text-xl font-black text-slate-900 font-headline">The Fluid Exchange</div>
                <p class="text-slate-500 max-w-xs text-sm">Platform kurasi aset digital masa depan untuk efisiensi operasional tanpa batas.</p>
                <div class="flex gap-4">
                    <a class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-xl">public</span>
                    </a>
                    <a class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-xl">groups</span>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                <div class="space-y-4">
                    <h4 class="font-bold text-slate-900 text-sm">Company</h4>
                    <nav class="flex flex-col gap-2">
                        <a class="text-slate-500 text-sm hover:text-indigo-500 transition-colors" href="#">Privacy Policy</a>
                        <a class="text-slate-500 text-sm hover:text-indigo-500 transition-colors" href="#">Terms of Service</a>
                    </nav>
                </div>
                <div class="space-y-4">
                    <h4 class="font-bold text-slate-900 text-sm">Support</h4>
                    <nav class="flex flex-col gap-2">
                        <a class="text-slate-500 text-sm hover:text-indigo-500 transition-colors" href="#">Help Center</a>
                        <a class="text-slate-500 text-sm hover:text-indigo-500 transition-colors" href="#">Contact Us</a>
                    </nav>
                </div>
                <div class="space-y-4 col-span-2 sm:col-span-1">
                    <h4 class="font-bold text-slate-900 text-sm">Contact</h4>
                    <p class="text-slate-500 text-sm italic">hello@fluidexchange.id</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-12 pt-8 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm">© {{ date('Y') }} The Fluid Exchange. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>