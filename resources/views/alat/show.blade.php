<x-app-layout>


    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="min-h-screen relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 50%, #fce7f3 100%);">
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-[-20%] right-[-10%] w-96 h-96 rounded-full opacity-15 animate-pulse" style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-96 h-96 rounded-full opacity-15 animate-pulse" style="background: radial-gradient(circle, #ec4899, transparent); animation-delay: 1s;"></div>
            <div class="absolute top-[50%] left-[50%] w-64 h-64 rounded-full opacity-10 animate-pulse" style="background: radial-gradient(circle, #60a5fa, transparent); animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 p-6 md:p-12">
            <main class="max-w-7xl mx-auto">
                <div class="glass-panel rounded-3xl shadow-2xl overflow-hidden hover-lift">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Image Section -->
                        <div class="lg:w-2/5 relative p-8 lg:p-12 flex items-center justify-center" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(236, 72, 153, 0.08));">
                            <div class="relative">
                                @if($alat->gambaralat)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $alat->gambaralat) }}" alt="{{ $alat->namaalat }}" class="w-full max-w-md h-auto object-contain rounded-2xl shadow-2xl transform hover:scale-105 transition-all duration-500" />
                                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-[#8127cf] rounded-3xl opacity-20 blur-xl -z-10"></div>
                                    </div>
                                @else
                                    <div class="w-80 h-80 bg-gradient-to-br from-white to-blue-50 rounded-3xl flex items-center justify-center shadow-2xl">
                                        <div class="text-center">
                                            <span class="material-symbols-outlined text-8xl text-blue-300 mb-4">inventory_2</span>
                                            <p class="text-blue-500 font-medium">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="lg:w-3/5 p-8 lg:p-12">
                            <!-- Header -->
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-blue-500 to-[#8127cf] flex items-center justify-center shadow-lg">
                                        <span class="material-symbols-outlined text-white text-xl">inventory</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold uppercase tracking-wider text-gray-600">Detail Equipment</p>
                                        <h1 class="text-4xl lg:text-5xl font-headline font-black text-gray-800 leading-tight">{{ $alat->namaalat }}</h1>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-3 mb-6">
                                    @if(Auth::user()->role !== 'user')
                                    <a href="{{ route('alat.edit', $alat) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                        Edit Item
                                    </a>
                                    @endif
                                    <a href="{{ Auth::user()->role === 'user' ? '/home' : route('alat.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white text-gray-700 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 border border-gray-300">
                                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                                        {{ Auth::user()->role === 'user' ? 'Beranda' : 'Kembali' }}
                                    </a>
                                </div>
                            </div>

                            <!-- Info Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-blue-100">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="material-symbols-outlined text-2xl text-blue-500">category</span>
                                        <span class="text-sm font-bold uppercase tracking-wider text-gray-600">Kategori</span>
                                    </div>
                                    <p class="text-xl font-bold text-gray-800">{{ $alat->kategori->namakategori ?? 'Tidak ada kategori' }}</p>
                                </div>

                                <div class="bg-white rounded-2xl p-6 shadow-lg border border-pink-100">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="material-symbols-outlined text-2xl text-pink-500">inventory</span>
                                        <span class="text-sm font-bold uppercase tracking-wider text-gray-600">Stok Tersedia</span>
                                    </div>
                                    <p class="text-3xl font-black text-gray-800">{{ $alat->qty }}</p>
                                    <p class="text-sm text-gray-600">Unit</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mb-8">
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border {{ $alat->qty > 0 ? 'border-blue-200 text-blue-700' : 'border-pink-200 text-pink-700' }} shadow-lg">
                                    <span class="material-symbols-outlined text-sm {{ $alat->qty > 0 ? 'text-blue-500' : 'text-pink-500' }}">{{ $alat->qty > 0 ? 'check_circle' : 'cancel' }}</span>
                                    <span class="font-bold text-sm">{{ $alat->qty > 0 ? 'Tersedia' : 'Habis' }}</span>
                                </div>
                            </div>

                            <!-- Specifications -->
                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-r from-blue-500 to-[#8127cf] flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-sm">description</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800">Spesifikasi</h3>
                                </div>
                                <div class="prose prose-gray max-w-none">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $alat->spesifikasi ?? 'Tidak ada spesifikasi yang tersedia untuk item ini.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
