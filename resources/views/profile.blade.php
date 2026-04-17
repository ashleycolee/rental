<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Info -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Informasi Profil</h3>
                    <div class="space-y-3">
                        <p><strong>Nama:</strong> {{ auth()->user()->namalengkap ?? auth()->user()->name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Role:</strong> <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ ucfirst(auth()->user()->role) }}</span></p>
                        @if(auth()->user()->role === 'admin')
                            <a href="/users" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium">
                                Kelola User
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Password Change Stub -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">Ubah Password</h3>
                    <p class="text-gray-600 mb-4">Fitur ganti password akan segera tersedia. Hubungi admin sementara.</p>
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Logout -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('logout', Auth::user()) }}">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium" onclick="return confirm('Yakin logout?')">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

