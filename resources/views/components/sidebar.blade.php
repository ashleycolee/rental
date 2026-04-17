<div class="fixed inset-y-0 left-0 z-50 w-1/4 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-200 ease-in-out" x-data="{ open: false }" :class="{ 'translate-x-0': open }">
    <div class="h-full flex flex-col">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-gray-200">
                            <a href="/home" class="flex items-center">
                    <span class="text-2xl font-extrabold tracking-tighter bg-gradient-to-br from-[#4648d4] to-[#8127cf] bg-clip-text text-transparent">The Fluid Exchange</span>
                </a>
        </div>

        <!-- Navigation -->
@if(auth()->user()->role === 'admin')
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{route('dashboard')}}" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="{{route('alat.index')}}" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_contains(request()->path(), 'alat') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Kelola Alat
            </a>

            <a href="/kategori" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 {{ str_contains(request()->path(), 'kategori') ? 'bg-indigo-50 text-indigo-600 border-2 border-indigo-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Kategori
            </a>

            <a href="{{route('peminjaman.index')}}" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ str_contains(request()->path(), 'peminjaman') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Peminjaman
            </a>

            <a href="{{route('alat-masuk.index')}}" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 {{ str_contains(request()->path(), 'alat-masuk') ? 'bg-purple-50 text-purple-600 border-2 border-purple-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Alat Masuk
            </a>
@endif
            @if(Auth::user()->role === 'admin')
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin</h3>
                <a href="{{route('users.index')}}" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-rose-50 hover:text-rose-600 transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-rose-50 text-rose-600 border-2 border-rose-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola User
                </a>
            </div>
@elseif(Auth::user()->role === 'petugas')
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Petugas</h3>
          
                <a href="{{ route('peminjaman.index') }}" class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ request()->routeIs('peminjaman.index') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Kelola Peminjaman
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 {{ request()->routeIs('laporan.index') ? 'bg-indigo-50 text-indigo-600 border-2 border-indigo-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan
                </a>

            </div>
            @elseif(Auth::user()->role === 'user')
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Peminjam</h3>
                <a href="/home" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ request()->is('beranda') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <a href="/peminjaman" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ request()->routeIs('peminjaman.user') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Riwayat Peminjaman
                </a>
            </div>
            @endif
        </nav>
    </div>

    <!-- Mobile toggle -->
    <button @click="open = !open" class="lg:hidden fixed top-4 left-4 z-60 p-2 rounded-lg bg-white shadow-lg">
        <svg class="w-6 h-6" :class="open ? 'text-gray-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

