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
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="w-full">
                @include('layouts.navigation')
                <main class="p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Hero -->
                        <div class="text-center mb-24">
                            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-slate-900 to-emerald-700 bg-clip-text text-transparent mb-6 drop-shadow-2xl">
                                Discover Items
                            </h1>
                            <p class="text-xl md:text-2xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                                Browse and borrow high-quality equipment with seamless approval workflow.
                            </p>
                        </div>

                        <!-- Filters -->
                        <div class="flex flex-col lg:flex-row gap-6 max-w-3xl mx-auto mb-20">
                            <div class="flex-1 bg-white/80 backdrop-blur p-1 rounded-3xl shadow-xl ring-1 ring-slate-200">
                                <div class="relative">
                                    <x-text-input wire:model.live.debounce.300ms="search" placeholder="🔍 Search all items..." class="w-full pl-16 pr-4 py-5 border-0 bg-transparent rounded-3xl text-lg focus:ring-emerald-500" />
                                    <svg class="absolute left-6 top-1/2 transform -translate-y-1/2 w-6 h-6 text-slate-400" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <select wire:model.live="selectedKategori" class="flex-1 px-6 py-5 border border-slate-200 bg-white/80 backdrop-blur rounded-3xl shadow-xl text-lg focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">All Categories</option>
                                @forelse($kategoris ?? [] as $id => $nama)
                                    <option value="{{ $id }}">{{ $nama }}</option>
                                @empty
                                    <option>No categories</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            {{-- @forelse($alat as $item)
                                <div class="group bg-white/70 backdrop-blur rounded-3xl shadow-2xl border border-white/50 overflow-hidden hover:shadow-emerald/20 hover:border-emerald-200/50 transition-all duration-500 hover:scale-[1.02]" wire:navigate.href="{{ route('alat.show', $item->idalat) }}">
                                    <!-- Image -->
                                    <div class="relative h-64 overflow-hidden bg-gradient-to-b from-slate-50 to-white">
                                        @if($item->gambaralat)
                                            <img src="{{ Storage::url($item->gambaralat) }}" alt="{{ $item->namaalat }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center bg-slate-100">
                                                <svg class="w-24 h-24 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <!-- Status -->
                                        <div class="absolute top-4 right-4">
                                            @if($item->qty > 0)
                                                <span class="px-4 py-2 bg-emerald-100 border border-emerald-200 text-emerald-800 font-bold text-sm rounded-2xl shadow-lg">Available</span>
                                            @else
                                                <span class="px-4 py-2 bg-slate-100 border border-slate-200 text-slate-800 font-bold text-sm rounded-2xl shadow-lg">Borrowed</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Card Content -->
                                    <div class="p-8">
                                        <h3 class="font-black text-2xl text-slate-900 mb-4 group-hover:text-emerald-700 transition-colors line-clamp-2">{{ $item->namaalat }}</h3>
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-full uppercase tracking-wide">{{ $item->kategori->namakategori ?? 'General' }}</span>
                                        </div>
                                        <p class="text-slate-600 leading-relaxed line-clamp-3 mb-6 text-lg">{{ \Illuminate\Support\Str::limit($item->spesifikasi, 150) }}</p>
                                        <div class="text-2xl font-black text-emerald-600 mb-2">{{ $item->qty }} {{ $item->qty > 1 ? 'available' : 'available' }}</div>
                                        @if($item->qty > 0)
                                            <x-primary-button wire:click="pinjam({{ $item->idalat }})" class="w-full font-bold shadow-lg bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-lg py-4 rounded-2xl transition-all transform hover:scale-105 hover:shadow-emerald/30">
                                                Borrow Now →
                                            </x-primary-button>
                                        @endif
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
                            @endforelse --}}
                        </div>

                        {{-- @if($alat->hasPages())
                            <div class="flex justify-center mt-24">
                                {{ $alat->links() }}
                            </div>
                        @endif --}}
                    </div>
                </main>

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
                        
                        <form wire:submit="submitPinjam">
                            <div class="grid md:grid-cols-2 gap-8 mb-12">
                                <div>
                                    <x-input-label for="tglpinjam" value="Start Date" />
                                    <x-text-input type="date" wire:model="form.tglpinjam" class="mt-3" />
                                    <x-input-error for="form.tglpinjam" />
                                </div>
                                <div>
                                    <x-input-label for="qty" value="Quantity" />
                                    <x-text-input type="number" wire:model="form.qty" min="1" class="mt-3" />
                                    <x-input-error for="form.qty" />
                                </div>
                            </div>
                            <div class="flex gap-4 pt-8 border-t border-slate-200">
                                <x-secondary-button wire:click="$set('showPinjamModal', false)" class="flex-1 h-14 text-lg font-bold rounded-2xl">Cancel</x-secondary-button>
                                <x-primary-button type="submit" wire:loading.attr="disabled" class="flex-1 h-14 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-lg font-black shadow-xl hover:shadow-emerald/40 rounded-2xl">
                                    Submit Request
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </x-modal>
            </div>
        </div>

        @livewireScripts
    </body>
</html>