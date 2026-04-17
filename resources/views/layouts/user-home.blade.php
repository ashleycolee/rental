<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peminjaman App - Beranda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen">
    <!-- Simple Top Header -->
    <header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/home" class="flex items-center space-x-2">
                       <span class="text-2xl font-extrabold tracking-tighter bg-gradient-to-br from-[#4648d4] to-[#8127cf] bg-clip-text text-transparent">The Fluid Exchange</span>
                        
                    </a>
                </div>

                <!-- Search Bar -->


                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4">
                    <div class="hidden lg:block text-sm font-medium text-gray-700 hover:text-gray-900">
                        <a href="/peminjaman-saya">Riwayat</a>
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <div class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-2xl transition-all cursor-pointer">
                                <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr(Auth::user()->username ?? '', 0, 2)) }}
                                </div>
                                <span class="font-semibold text-gray-900 hidden lg:block">{{ Auth::user()->namalengkap ?? Auth::user()->username }}</span>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile') }}">Profile</x-dropdown-link>
                            <x-dropdown-link href="{{ route('profile', ['#password-form']) }}">Ganti Password</x-dropdown-link>
                            <hr class="my-2 border-gray-200">
    <form method="POST" action="{{ route('logout') }}" class="w-full">
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

    <!-- Main Content -->
    <main class="pt-4 pb-12 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
