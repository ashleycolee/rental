<div class="fixed inset-y-0 left-0 z-50 w-1/4 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-200 ease-in-out" x-data="{ open: false }" :class="{ 'translate-x-0': open }">
    <div class="h-full flex flex-col">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl text-gray-900">Peminjaman App</h2>
                    <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->role ?? 'user') }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
@if(auth()->user()->role === 'admin')
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="/dashboard" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="/alat" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_contains(request()->path(), 'alat') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
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

<a href="/peminjaman" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ str_contains(request()->path(), 'peminjaman') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Peminjaman
            </a>

            <a href="/alat-masuk" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 {{ str_contains(request()->path(), 'alat-masuk') ? 'bg-purple-50 text-purple-600 border-2 border-purple-200' : '' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Alat Masuk
            </a>


            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin</h3>
                <a href="/alat" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ request()->routeIs('alat.*') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Kelola Alat
                </a>
                <a href="/kategori" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 {{ request()->routeIs('kategori.*') ? 'bg-indigo-50 text-indigo-600 border-2 border-indigo-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Kategori
                </a>
                <a href="/alat-masuk" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 {{ request()->routeIs('alat-masuk.*') ? 'bg-purple-50 text-purple-600 border-2 border-purple-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Alat Masuk
                </a>
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Kelola</h3>
                <a href="/manageaccount" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-rose-50 hover:text-rose-600 transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-rose-50 text-rose-600 border-2 border-rose-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola User
                </a>
            </div>
@elseif(auth()->user()->role === 'petugas')
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Petugas</h3>
                <a href="/alat" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_contains(request()->path(), 'alat') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Daftar Barang
                </a>
                <a href="/peminjaman" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ str_contains(request()->path(), 'peminjaman') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Kelola Peminjaman
                </a>
            </div>
@elseif(auth()->user()->role === 'user')
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Peminjam</h3>
                <a href="/beranda" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ request()->is('beranda') ? 'bg-blue-50 text-blue-600 border-2 border-blue-200' : '' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <a href="/peminjaman-saya" wire:navigate class="flex items-center p-3 rounded-xl text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 {{ request()->routeIs('peminjaman.user') ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-200' : '' }}">
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

