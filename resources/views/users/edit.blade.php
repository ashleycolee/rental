<x-app-layout>


    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.edit', $user) }}">
                @csrf
                @method('PUT')
                <div class="bg-white shadow-sm rounded-lg p-8">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="username" :value="'Username'" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required />
                            <x-input-error :messages="$errors->get('username')" />
                        </div>

                        <div>
                            <x-input-label for="namalengkap" :value="'Nama Lengkap'" />
                            <x-text-input id="namalengkap" name="namalengkap" type="text" class="mt-1 block w-full" :value="old('namalengkap', $user->namalengkap)" required />
                            <x-input-error :messages="$errors->get('namalengkap')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="'Email'" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="identitas" :value="'Identitas'" />
                            <x-text-input id="identitas" name="identitas" type="text" class="mt-1 block w-full" :value="old('identitas', $user->identitas)" />
                            <x-input-error :messages="$errors->get('identitas')" />
                        </div>

                        <div>
                            <x-input-label for="nohp" :value="'No. HP'" />
                            <x-text-input id="nohp" name="nohp" type="text" class="mt-1 block w-full" :value="old('nohp', $user->nohp)" />
                            <x-input-error :messages="$errors->get('nohp')" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="'Role'" />
                            <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                                Update User
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
