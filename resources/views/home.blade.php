<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="w-full">
                @include('layouts.navigation')
               
<main class="pt-20">
<!-- Hero Banner -->
<section class="relative px-8 pt-12 pb-24 overflow-hidden">
<div class="absolute inset-0 -z-10 bg-linear-to-r from-[#4648d4] via-[#8127cf] to-[#006387] opacity-10"></div>
<div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/20 rounded-full blur-[100px]"></div>
<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12">
<div class="flex-1 space-y-8 text-left">
<h1 class="text-5xl lg:text-7xl font-extrabold font-headline leading-[1.1] tracking-tighter text-on-surface">
                        Temukan &amp; <br/>
<span class="bg-gradient-to-br from-[#4648d4] to-[#8127cf] bg-clip-text text-transparent">Pinjam Barang</span> <br/>
                        dengan Mudah
                    </h1>
<p class="text-body text-on-surface-variant text-lg max-w-lg leading-relaxed">
                        Akses ribuan aset berkualitas tinggi dari komunitas terpercaya. Dari perangkat kreatif hingga peralatan riset, semuanya tersedia dalam satu ekosistem.
                    </p>
<div class="flex flex-wrap gap-4">
<button class="px-8 py-4 bg-gradient-to-br from-[#4648d4] to-[#8127cf]  text-white font-bold rounded-xl shadow-[0_8px_20px_-4px_rgba(70,72,212,0.3)] hover:scale-105 transition-all active:scale-95">
                            Jelajahi Sekarang
                        </button>
<button class="px-8 py-4 bg-white/50 backdrop-blur-md border border-outline-variant/30 text-on-surface font-semibold rounded-xl hover:bg-white/80 transition-all">
                            Cara Kerja
                        </button>
</div>
</div>
<div class="flex-1 relative">
<div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 group">
<img class="w-full aspect-[4/3] object-cover" data-alt="modern minimalist workspace with high-end laptop, headphones, and designer stationery on a clean desk at golden hour" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6T0LVHE7Kl7r2uvxzkMzWIT1aPNGMf5Xjluayth96czhWCqgt71ak_m3E6pILX65_8a8gyttopEn9e3GIcKSLnn5kGVM09w1gl1maFNvnGZySehK-Oo2o5wU6SWeFuI4-yVHMICCKIiynizUB3clyYiCp8WL8Wva0XBaWbYGUPzVyuTN0vmGjC9vc3jJ88MpPh7FCjkiSQyGh_g4TCkm2oWTOm-2OUIhVY-9dfEb8xpNTGlT6mFma8OUMXQLRBouRdSD3x1E1aWeL"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
</div>
<div class="absolute -bottom-6 -left-6 z-20 glass-card bg-white/70 p-6 rounded-2xl shadow-xl border border-white/50">
<div class="flex items-center gap-4">
<div class="p-3 bg-primary/10 rounded-xl">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
<div>
<p class="text-xs font-bold text-outline uppercase tracking-widest">Status</p>
<p class="text-on-surface font-bold">12k+ Item Terverifikasi</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Search & Categories -->
<section class="px-8 -mt-12 relative z-30">
<div class="max-w-5xl mx-auto">
<div class="glass-card bg-white/80 p-4 rounded-3xl shadow-Ambient flex flex-col md:flex-row gap-4 border border-white/50">
<div class="flex-1 relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary">search</span>
<input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl focus:ring-2 focus:ring-primary/20" placeholder="Apa yang ingin Anda pinjam hari ini?" type="text"/>
</div>
<div class="flex gap-2 items-center px-4 overflow-x-auto no-scrollbar whitespace-nowrap">
<span class="text-sm font-semibold text-outline px-2">Kategori:</span>
<div class="flex gap-2">
<button class="px-4 py-2 bg-gradient-to-br from-blue-500 to-[#8127cf] text-white text-sm font-bold rounded-full">Semua</button>
<button class="px-4 py-2 bg-[#e6e8ea] hover:bg-[#e6e8ea] transition-colors text-on-surface-variant text-sm font-medium rounded-full">Elektronik</button>
<button class="px-4 py-2 bg-[#e6e8ea] hover:bg-[#e6e8ea] transition-colors text-on-surface-variant text-sm font-medium rounded-full">Alat Lab</button>
<button class="px-4 py-2 bg-[#e6e8ea] hover:bg-[#e6e8ea] transition-colors text-on-surface-variant text-sm font-medium rounded-full">Kamera</button>
<button class="px-4 py-2 bg-[#e6e8ea] hover:bg-[#e6e8ea] transition-colors text-on-surface-variant text-sm font-medium rounded-full">Audio</button>
<button class="px-4 py-2 bg-[#e6e8ea] hover:bg-[#e6e8ea] transition-colors text-on-surface-variant text-sm font-medium rounded-full">Perlengkapan Kantor</button>
</div>
</div>
</div>
</div>
</section>
                <main class="p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Hero -->
                        
                        <!-- Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            @forelse($alat as $item)
                    <div
   class="group bg-surface-container-lowest rounded-xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">

    <!-- Image -->
    <div class="relative rounded-xl overflow-hidden mb-6 aspect-square bg-surface-container-low">
        @if($item->gambaralat)
            <img src="{{ Storage::url($item->gambaralat) }}" 
                 alt="{{ $item->namaalat }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        @else
            <div class="absolute inset-0 flex items-center justify-center bg-slate-100">
                <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                </svg>
            </div>
        @endif

        <!-- Status -->
        <div class="absolute top-3 left-3">
            @if($item->qty > 0)
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full backdrop-blur-md border border-emerald-200">
                    Tersedia
                </span>
            @else
                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full border border-red-200">
                    Dipinjam
                </span>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="space-y-1 mb-6">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
            {{ $item->kategori->namakategori ?? 'General' }}
        </p>

        <h3 class="text-xl font-bold text-slate-900 line-clamp-2">
            {{ $item->namaalat }}
        </h3>

        <p class="text-sm text-slate-500 line-clamp-2">
            {{ \Illuminate\Support\Str::limit($item->spesifikasi, 80) }}
        </p>
    </div>

    <!-- Footer -->
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs text-slate-400 font-medium">Stok</p>
            <p class="font-bold text-indigo-600">
                {{ $item->qty }}
            </p>
        </div>

        <div class="flex gap-2">
        @if($item->qty > 0)
        <a href="{{ route('alat.show', $item->idalat) }}"
        class="px-4 py-2.5 bg-slate-200 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-full hover:scale-105 active:scale-95 transition-all">
            Detail
        </a>
        <a href="{{ route('peminjaman.create', $item->idalat) }}"
        class=" px-4 py-2.5 bg-gradient-to-r from-[#4648d4] to-[#8127cf] text-white text-xs font-bold rounded-full hover:scale-105 active:scale-95 transition-all">
            Pinjam
        </a>
        @endif
        </div>
    </div>

</div>
                            @empty
                                <div class="col-span-full p-32 text-center bg-white/50 rounded-3xl backdrop-blur border border-dashed border-slate-300">
                                    <svg class="mx-auto w-24 h-24 text-slate-400 mb-8" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <h2 class="text-3xl font-black text-slate-900 mb-4">Nothing here yet</h2>
                                    <p class="text-xl text-slate-600 max-w-md mx-auto">No items match your search. Try adjusting your filters or check back soon.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($alat->hasPages())
                            <div class="flex justify-center mt-24">
                                {{ $alat->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Borrow Modal -->
                <x-modal wire:model="showPinjamModal" maxWidth="2xl">
                    <div class="p-10">
                        <div class="flex items-start mb-10">
                            <div class="flex-shrink-0 p-4 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-3xl mr-6 shadow-lg">
                                <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 9M7 13l-1.5 9m12 0L17 13m-4 0l1.5 9" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 mb-2">Request Item</h2>
                                <p class="text-xl text-slate-600">Complete form to submit borrowing request. Approval within 24h.</p>
                            </div>
                        </div>
                        
                 
                    </div>
                </x-modal>
            </div>
        </div>

        @livewireScripts
    </body>
</html>