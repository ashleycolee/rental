<!-- Simple Top Header -->
<header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/home" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-gray-900 hidden md:block">Peminjaman</span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-md mx-8 hidden lg:block">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="global-search" type="text" placeholder="Cari barang..." class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-white/50">
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="flex items-center space-x-4">
                <div class="hidden lg:block text-sm font-medium text-gray-700 hover:text-gray-900">
                    <a href="{{ route('peminjaman.user') }}">Riwayat</a>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-2xl transition-all cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(auth()->user()->username ?? '', 0, 2)) }}
                            </div>
                            <span class="font-semibold text-gray-900 hidden lg:block">{{ auth()->user()->namalengkap ?? auth()->user()->username }}</span>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile') }}">Profile</x-dropdown-link>
                        <x-dropdown-link href="{{ route('profile', ['#password-form']) }}">Ganti Password</x-dropdown-link>
                        <hr class="my-2 border-gray-200">
                        <form method="POST" action="{{ route('logout', Auth::user()) }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg transition-colors">
                                Logout
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</header>