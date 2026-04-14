<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ Auth::user()->role === 'user' ? '/beranda' : '/dashboard' }}" wire:navigate class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-gray-900 hidden lg:block">Peminjaman App</span>
                </a>
            </div>

            <!-- Search (future use) -->
            <div class="flex-1 max-w-md mx-8 hidden lg:block">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari alat atau peminjaman..." class="w-full pl-11 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <!-- Right side: Notifications & Profile -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <button class="relative p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute -top-1 -right-1 block w-5 h-5 rounded-full bg-red-500 text-white text-xs font-bold flex items-center justify-center">3</span>
                </button>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-xl transition-all duration-200 cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->username ?? Auth::user()->name ?? '', 0, 2)) }}
                            </div>
                            <div class="hidden lg:block">
                                <p class="font-semibold text-gray-900 text-sm">{{ Auth::user()->namalengkap ?? Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role ?? 'user') }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                    @if(Auth::user()->role === 'user')
                        <x-dropdown-link href="/beranda" wire:navigate>
                            Beranda
                        </x-dropdown-link>
                        <x-dropdown-link href="/peminjaman-saya" wire:navigate>
                            Riwayat Peminjaman
                        </x-dropdown-link>
                    @endif
                    <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile', ['#password-form'])" wire:navigate>
                            Ganti Password
                        </x-dropdown-link>
                        @if(Auth::user()->role === 'admin')
                        <x-dropdown-link href="/users" wire:navigate>
                            Kelola User
                        </x-dropdown-link>
                        @endif
                        <hr class="my-2 border-gray-200">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-gray-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg transition-colors">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</div>

