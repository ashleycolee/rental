<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $username = '';
    public string $namalengkap = '';
    public string $identitas = '';
    public string $nohp = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'user';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'namalengkap' => ['required', 'string', 'max:255'],
            'identitas' => ['nullable', 'string', 'max:255'],
            'nohp' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['user'])],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

$this->redirect(Auth::user()->role === 'user' ? '/beranda' : '/dashboard', navigate: true);
    }
}; ?>

<div class="min-h-screen w-full flex flex-col md:flex-row font-body bg-surface text-on-surface antialiased overflow-hidden">

    {{-- Left Side: Visual Anchor --}}
    <section class="hidden md:flex md:w-1/2 fluid-bg items-center justify-center relative">
        {{-- Decorative Fluid Blobs --}}
        <div class="fluid-blob w-[500px] h-[500px] bg-secondary top-[-10%] left-[-10%]"></div>
        <div class="fluid-blob w-[400px] h-[400px] bg-tertiary-container bottom-[-5%] right-[-5%]"></div>
        <div class="fluid-blob w-[300px] h-[300px] bg-primary-container top-[20%] right-[10%]"></div>

        <div class="relative z-10 p-12 text-white">
            <div class="mb-8">
                <h1 class="font-headline font-extrabold text-5xl tracking-tighter mb-4">The Fluid Exchange</h1>
                <div class="h-1.5 w-24 bg-gradient-to-r from-primary-container to-secondary-fixed-dim rounded-full"></div>
            </div>
            <p class="font-headline text-2xl font-light leading-relaxed max-w-md opacity-90">
                A high-end digital curator for your premium asset ecosystem.
            </p>
            <div class="mt-16 relative w-full aspect-square max-w-md">
                <img
                    class="w-full h-full object-contain mix-blend-screen drop-shadow-2xl"
                    alt="Abstract 3D fluid sculpture with metallic and glass textures"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBU_lh8xIM1VX6AcbR2j7kxOQtXoVU6HDGptg7qXWXQ4CSkudKOJh-mtdIw5gtZZW1Ay_8MWLErwl9TEBTeaVNDjNnOBxveweA71NFTnA7_oLCWHRi-0IK_IlRGYX4SFnse9g2zcU6okkyUgFjyZMRsLYdSQbzVnZktx5FVWil8BH8h6siqiD7OZghK2xB3Qr5gZ6ezdpIF53Q2yGy7619d7AasNlrUCBFBmT_UYp1jsXE_BN-Yk6xwd4jU6pigOz5K7268RJ80V5Nh"
                />
            </div>
        </div>
    </section>

    {{-- Right Side: Registration Form --}}
    <section class="w-full md:w-1/2 h-screen flex items-center justify-center p-6 md:p-12 bg-surface relative overflow-y-auto no-scrollbar">
        {{-- Mobile Background Hint --}}
        <div class="md:hidden absolute inset-0 fluid-bg opacity-10"></div>

        <div class="w-full max-w-lg relative z-10">

            {{-- Branding for Mobile --}}
            <div class="md:hidden mb-8 text-center">
                <span class="font-headline font-extrabold text-2xl bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    The Fluid Exchange
                </span>
            </div>

            <div class="mb-5">
                <h2 class="font-headline font-bold text-4xl text-on-surface tracking-tight mb-2">Daftar Akun Baru</h2>
                <p class="text-on-surface-variant text-lg">Mulai pengalaman peminjaman yang lebih mudah</p>
            </div>

            <form wire:submit="register" class="space-y-2">

                {{-- Nama Lengkap --}}
                <div class="space-y-1">
                    <label for="namalengkap" class="text-sm font-semibold text-on-surface-variant ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">person</span>
                        <input
                            wire:model="namalengkap"
                            id="namalengkap"
                            type="text"
                            name="namalengkap"
                            required
                            autofocus
                            placeholder="John Doe"
                            class="w-full pl-12 pr-4 py-2 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest focus:outline-none transition-all placeholder:text-outline-variant text-sm leading-tight"
                        />

                    </div>
                    <x-input-error :messages="$errors->get('namalengkap')" class="mt-1 ml-1" />
                </div>

                {{-- Username & Identitas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Username --}}
                    <div class="space-y-1">
                        <label for="username" class="text-sm font-semibold text-on-surface-variant ml-1">Username</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">alternate_email</span>
                            <input
                                wire:model="username"
                                id="username"
                                type="text"
                                name="username"
                                required
                                placeholder="johndoe"
                                class="w-full pl-12 pr-4 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest focus:outline-none transition-all text-sm placeholder:text-outline-variant"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-1 ml-1" />
                    </div>

                    {{-- Identitas --}}
                    <div class="space-y-1">
                        <label for="identitas" class="text-sm font-semibold text-on-surface-variant ml-1">Identitas (ID Number)</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">badge</span>
                            <input
                                wire:model="identitas"
                                id="identitas"
                                type="text"
                                name="identitas"
                                placeholder="3201..."
                                class="w-full pl-12 pr-4 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest focus:outline-none transition-all text-sm placeholder:text-outline-variant"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('identitas')" class="mt-1 ml-1" />
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="space-y-1">
                    <label for="nohp" class="text-sm font-semibold text-on-surface-variant ml-1">Nomor HP</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">phone_iphone</span>
                        <input
                            wire:model="nohp"
                            id="nohp"
                            type="tel"
                            name="nohp"
                            placeholder="0812 3456 7890"
                            class="w-full pl-12 pr-4 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest text-sm focus:outline-none transition-all placeholder:text-outline-variant"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('nohp')" class="mt-1 ml-1" />
                </div>

                {{-- Email --}}
                <div class="space-y-1">
                    <label for="email" class="text-sm font-semibold text-on-surface-variant ml-1">Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">mail</span>
                        <input
                            wire:model="email"
                            id="email"
                            type="email"
                            name="email"
                            required
                            autocomplete="username"
                            placeholder="john@example.com"
                            class="w-full pl-12 pr-4 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest text-sm focus:outline-none transition-all placeholder:text-outline-variant"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
                </div>

                {{-- Password --}}
                <div class="space-y-1">
                    <label for="password" class="text-sm font-semibold text-on-surface-variant ml-1">Password</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                        <input
                            wire:model="password"
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full pl-12 pr-12 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest focus:outline-none transition-all placeholder:text-outline-variant"
                        />
                        <button type="button" onclick="togglePassword('password', 'pw-icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" id="pw-icon">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-1">
                    <label for="password_confirmation" class="text-sm font-semibold text-on-surface-variant ml-1">Konfirmasi Password</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock_reset</span>
                        <input
                            wire:model="password_confirmation"
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full pl-12 pr-12 py-2 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest focus:outline-none transition-all placeholder:text-outline-variant"
                        />
                        <button type="button" onclick="togglePassword('password_confirmation', 'pw-confirm-icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" id="pw-confirm-icon">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-1" />
                </div>

                {{-- Submit Button --}}
                <div class="pt-6">
                    <button
                        type="submit"
                        class="w-full py-5 rounded-xl bg-gradient-to-r from-[#4648d4] to-[#8127cf] text-white font-headline font-bold text-lg shadow-[0_8px_20px_-6px_rgba(70,72,212,0.5)] hover:scale-[1.02] hover:shadow-[0_12px_24px_-4px_rgba(70,72,212,0.6)] active:scale-[0.98] transition-all duration-300"
                    >
                        Daftar
                    </button>
                </div>

            </form>

            {{-- Login Link --}}
            <div class="mt-10 text-center">
                <p class="text-on-surface-variant">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" wire:navigate class="text-primary font-bold hover:underline underline-offset-4 decoration-primary/30 transition-all ml-1">
                        Login
                    </a>
                </p>
            </div>

        </div>

        {{-- Background Decoration --}}
        <div class="absolute bottom-10 right-10 opacity-20 pointer-events-none">
            <div class="w-48 h-48 bg-primary-container rounded-full blur-3xl"></div>
        </div>
        <div class="absolute top-10 left-10 opacity-10 pointer-events-none">
            <div class="w-32 h-32 bg-secondary rounded-full blur-2xl"></div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="fixed bottom-0 w-full z-20 pointer-events-none">
        <div class="max-w-7xl mx-auto px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-[0.2em] font-label text-outline/40">
            <div class="pointer-events-auto">© {{ date('Y') }} The Fluid Exchange. The Digital Curator.</div>
            <div class="flex gap-6 pointer-events-auto">
                <a href="#" class="hover:text-primary transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-primary transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>

</div>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        vertical-align: middle;
    }
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .fluid-bg {
        background: linear-gradient(135deg, #4648d4 0%, #8127cf 50%, #007da9 100%);
        position: relative;
        overflow: hidden;
    }
    .fluid-blob {
        position: absolute;
        filter: blur(60px);
        opacity: 0.6;
        border-radius: 50%;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }

    /* Color tokens */
    .bg-surface { background-color: #f7f9fb; }
    .bg-surface-container-low { background-color: #f2f4f6; }
    .bg-surface-container-lowest { background-color: #ffffff; }
    .bg-primary-container { background-color: #6063ee; }
    .bg-secondary { background-color: #8127cf; }
    .bg-secondary-fixed-dim { background-color: #ddb7ff; }
    .bg-tertiary-container { background-color: #007da9; }
    .text-on-surface { color: #191c1e; }
    .text-on-surface-variant { color: #464554; }
    .text-outline { color: #767586; }
    .text-outline-variant { color: #c7c4d7; }
    .text-primary { color: #4648d4; }
    .text-white { color: #ffffff; }
    .from-primary { --tw-gradient-from: #4648d4; }
    .to-secondary { --tw-gradient-to: #8127cf; }
    .from-primary-container { --tw-gradient-from: #6063ee; }
    .to-secondary-fixed-dim { --tw-gradient-to: #ddb7ff; }
    .focus\:ring-primary\/20:focus { --tw-ring-color: rgba(70, 72, 212, 0.2); }
    .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-body { font-family: 'Inter', sans-serif; }
    .font-label { font-family: 'Inter', sans-serif; }
    .text-outline\/40 { color: rgba(118, 117, 134, 0.4); }
    .hover\:text-primary:hover { color: #4648d4; }
    .group-focus-within\:text-primary:focus-within { color: #4648d4 !important; }
    .border-none { border: none !important; }
</style>
@endpush

@push('scripts')
<script>
    function togglePassword(fieldId, iconId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endpush