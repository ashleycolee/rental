<x-app-layout>
    <div class="min-h-screen w-full flex font-body bg-surface text-on-surface antialiased">

        {{-- Left Side: Abstract Dashboard Preview --}}
        <div class="hidden lg:flex w-1/2 relative overflow-hidden bg-surface-container-low items-center justify-center p-12">
            {{-- Background Decorative Blobs --}}
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 rounded-full bg-primary/10 blur-[100px]"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 rounded-full bg-secondary/10 blur-[100px]"></div>

            <div class="relative w-full max-w-2xl z-10">
                {{-- Abstract Dashboard Mockup --}}
                <div class="glass-panel ambient-shadow rounded-xl p-8 border border-white/20 transform -rotate-2">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-error/40"></div>
                            <div class="w-3 h-3 rounded-full bg-tertiary-container/40"></div>
                            <div class="w-3 h-3 rounded-full bg-primary/40"></div>
                        </div>
                        <div class="h-4 w-32 bg-surface-container-highest/50 rounded-full"></div>
                    </div>

                    {{-- Bento Grid Items --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-container-lowest rounded-lg p-4 flex flex-col gap-3">
                            <div class="w-full aspect-video rounded-md bg-surface-variant overflow-hidden">
                                <img class="w-full h-full object-cover opacity-80"
                                    alt="Modern sleek laptop on a minimalist white desk"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO5LByqdBu_YBQd0i7BwmI2vd5pN96TE1zo6TQkMqU-UBnbu-g_KD5qEj4LMZOFxX-U4Ka8nLtuEO2bi5v0PXuNv2899KfP2xHvogyT1gJbkQ0Gd4KpgPRDC2Fe_VH6JiP0xMf2HY5kBrj52vnM9do4w7RIuOjQHLO3BZ7S3JQc_NsM9KClbj6edvW2l_i2xKYrKBxm8G2YgC73qM4aVGaM3lRdmUiWtTLKHSZ2ITIhox4eea0e5B5XnnULtYg3BRNBW3DPXrrQzUT"/>
                            </div>
                            <div class="h-3 w-3/4 bg-surface-container-highest rounded-full"></div>
                            <div class="h-2 w-1/2 bg-surface-container-highest rounded-full"></div>
                        </div>
                        <div class="bg-surface-container-lowest rounded-lg p-4 flex flex-col gap-3">
                            <div class="w-full aspect-video rounded-md bg-surface-variant overflow-hidden">
                                <img class="w-full h-full object-cover opacity-80"
                                    alt="Premium wireless headphones on a wooden surface"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5tpyX9tjLvkQYNWTuDQ_vVfz911JoXL9JwTivTW9as319QVOlyhW4EthXwuZGAoOzs1rmI6qQ3aoIlKtMtpUtUMvytUqJ_4c6AQls8WBpk7Lt3zAVUtdoP8CXsKiDjQWlvKgA9yiP1KHJD-jpZ0Gb7tHrKB2lmc8prDs1KkHDaK1G6SpJhZ5tlXoxIkpbpA501NuLpDrmAWLVFbrt6dJ6vSclCOEW_5MGwkWpxRKoKvPFXjV3Wnxs7nPQWiWbD38rBl5ZCzSrOnex"/>
                            </div>
                            <div class="h-3 w-3/4 bg-surface-container-highest rounded-full"></div>
                            <div class="h-2 w-1/2 bg-surface-container-highest rounded-full"></div>
                        </div>
                        <div class="col-span-2 bg-primary/5 rounded-lg p-6 border border-primary/10">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full kinetic-gradient flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined">sync_alt</span>
                                </div>
                                <div class="flex-1">
                                    <div class="h-4 w-1/3 bg-primary/20 rounded-full mb-2"></div>
                                    <div class="h-3 w-1/2 bg-primary/10 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Editorial Tag --}}
                <div class="absolute -bottom-6 -right-6 glass-panel p-6 rounded-xl ambient-shadow border border-white/40 max-w-xs transform rotate-3">
                    <p class="font-headline font-bold text-lg text-slate-900 leading-tight">
                        Experience the fluid movement of assets.
                    </p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-200"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-300"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-400"></div>
                        </div>
                        <span class="text-xs text-slate-500 font-medium">1.2k+ Borrowers</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side: Login Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16 bg-surface-container-lowest">
            <div class="w-full max-w-md">

                {{-- Brand Header --}}
                <div class="mb-12">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 mb-2 font-headline">
                        The Fluid Exchange
                    </h2>
                    <div class="h-1.5 w-12 kinetic-gradient rounded-full"></div>
                </div>

                <div class="mb-10">
                    <h1 class="text-3xl font-headline font-bold text-on-surface mb-3 tracking-tight">Selamat Datang</h1>
                    <p class="text-on-surface-variant font-body">Silakan login untuk melanjutkan pengelolaan inventaris Anda.</p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form action="{{route('login')}}" method="POST" class="space-y-6">
                    @csrf
                        <x-input-error :messages="$errors->get('auth')" class="mt-2" />

                    {{-- Email Field --}}
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-on-surface-variant mb-2 ml-1">
                            {{ __('Email') }}
                        </label>
                        <div class="relative">
                            <input
                                wire:model="form.email"
                                id="email"
                                type="text"
                                name="email"
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email Anda"
                                class="w-full px-4 py-4 bg-surface-container-high border-none rounded-lg focus:ring-0 text-on-surface transition-all placeholder:text-slate-400 focus:outline-none"
                            />
                            <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-primary group-focus-within:w-full transition-all duration-300 rounded-b-lg"></div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password Field --}}
                    <div class="group">
                        <label for="password" class="block text-sm font-semibold text-on-surface-variant mb-2 ml-1">
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input
                                wire:model="form.password"
                                id="password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full px-4 py-4 bg-surface-container-high border-none rounded-lg focus:ring-0 text-on-surface transition-all placeholder:text-slate-400 focus:outline-none pr-12"
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                            >
                                <span class="material-symbols-outlined" id="toggle-icon">visibility</span>
                            </button>
                            <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-primary group-focus-within:w-full transition-all duration-300 rounded-b-lg"></div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input
                                wire:model="form.remember"
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary/20 transition-all"
                            />
                            <span class="text-on-surface-variant group-hover:text-on-surface transition-colors">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                wire:navigate
                                class="text-primary font-semibold hover:underline decoration-primary/30 transition-all"
                            >
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full kinetic-gradient text-white py-4 px-6 rounded-xl font-bold text-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 mt-4"
                    >
                        {{ __('Masuk') }}
                    </button>

                </form>

                {{-- Register Link --}}
                @if (Route::has('register'))
                    <div class="mt-12 text-center">
                        <p class="text-on-surface-variant text-sm">
                            Belum punya akun?
                            <a href="{{ route('register') }}" wire:navigate class="text-primary font-bold ml-1 hover:underline decoration-primary/30">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                @endif

            </div>
        </div>

        {{-- Minimal Legal Footer (right side only) --}}
        <footer class="fixed bottom-0 right-0 w-full lg:w-1/2 p-8 hidden md:block pointer-events-none">
            <div class="flex justify-between items-center opacity-40 text-[10px] font-body uppercase tracking-widest font-medium pointer-events-auto">
                <span>© {{ date('Y') }} THE FLUID EXCHANGE</span>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-primary transition-colors">PRIVACY</a>
                    <a href="#" class="hover:text-primary transition-colors">TERMS</a>
                </div>
            </div>
        </footer>

    </div>

    {{-- Styles & Scripts --}}
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .kinetic-gradient {
            background: linear-gradient(135deg, #4648d4 0%, #8127cf 100%);
        }
        .ambient-shadow {
            box-shadow: 0 12px 32px -4px rgba(70, 72, 212, 0.04);
        }

        /* Color tokens as CSS custom properties */
        .bg-primary\/10 { background-color: rgba(70, 72, 212, 0.1); }
        .bg-secondary\/10 { background-color: rgba(129, 39, 207, 0.1); }
        .bg-primary\/5 { background-color: rgba(70, 72, 212, 0.05); }
        .bg-primary\/20 { background-color: rgba(70, 72, 212, 0.2); }
        .bg-primary\/10 { background-color: rgba(70, 72, 212, 0.1); }
        .border-primary\/10 { border-color: rgba(70, 72, 212, 0.1); }
        .bg-surface-container-high { background-color: #e6e8ea; }
        .bg-surface-container-highest { background-color: #e0e3e5; }
        .bg-surface-container-lowest { background-color: #ffffff; }
        .bg-surface-container-low { background-color: #f2f4f6; }
        .bg-surface-variant { background-color: #e0e3e5; }
        .text-on-surface { color: #191c1e; }
        .text-on-surface-variant { color: #464554; }
        .text-primary { color: #4648d4; }
        .bg-error\/40 { background-color: rgba(186, 26, 26, 0.4); }
        .bg-tertiary-container\/40 { background-color: rgba(0, 125, 169, 0.4); }
        .bg-primary\/40 { background-color: rgba(70, 72, 212, 0.4); }
        .text-white { color: #ffffff; }
        .border-outline-variant { border-color: #c7c4d7; }
        .shadow-primary\/20 { --tw-shadow-color: rgba(70, 72, 212, 0.2); }
        .bg-surface { background-color: #f7f9fb; }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        .focus\:ring-primary\/20:focus { --tw-ring-color: rgba(70, 72, 212, 0.2); }
        input[type="checkbox"].text-primary { accent-color: #4648d4; }
    </style>
    @endpush

    @push('scripts')
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggle-icon');
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
</x-app-layout>