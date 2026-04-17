<x-app-layout>

    <style>
        .font-plus-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <div class="p-10 min-h-screen relative" style="background-color: #f7f9fb;">
        <!-- Fluid background decorative elements -->
        <div class="absolute top-[-10%] right-[-5%] w-96 h-96 rounded-full blur-3xl -z-10" style="background: rgba(70, 72, 212, 0.05);"></div>
        <div class="absolute bottom-[10%] left-[-5%] w-72 h-72 rounded-full blur-3xl -z-10" style="background: rgba(129, 39, 207, 0.05);"></div>

        @if (session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-4xl font-extrabold font-plus-jakarta tracking-tight mb-2" style="color: #191c1e;">Manajemen Kategori</h2>
                <p style="color: #464554;">Kelola kategori barang dengan rapi untuk memastikan sirkulasi aset tetap terjaga dalam ekosistem digital.</p>
            </div>
            <a href="{{ route('kategori.create') }}" class="flex items-center gap-2 px-8 py-4 text-white rounded-xl font-bold hover:scale-105 transition-transform whitespace-nowrap" style="background: linear-gradient(to right, #4648d4, #8127cf); box-shadow: 0 8px 20px -4px rgba(70, 72, 212, 0.3);">
                <span class="material-symbols-outlined">add</span>
                Tambah Kategori
            </a>
        </div>

        <!-- Search Bar -->
        <div class="mb-10">
            <form method="GET" action="{{ route('kategori.index') }}">
                <div class="relative max-w-md">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2" style="color: #9ca3af;">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="w-full pl-10 pr-4 py-3 border-none rounded-full focus:ring-2 transition-all" style="background-color: rgba(230, 232, 234, 0.5); color: #191c1e;" onfocus="this.style.boxShadow='0 0 0 2px rgba(70, 72, 212, 0.2)'">
                </div>
            </form>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse ($kategoris as $item)
                <div class="group p-8 rounded-[1.5rem] hover:translate-y-[-4px] transition-all duration-300 relative overflow-hidden" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-[4rem] -z-0" style="background: rgba(70, 72, 212, 0.05);"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: #e8eaf6; color: #4648d4;">
                                <span class="material-symbols-outlined text-3xl">category</span>
                            </div>
                            <span class="px-4 py-1 text-xs font-bold rounded-full" style="background: rgba(0, 99, 135, 0.1); color: #006387;">{{ $item->alat()->count() }} Barang</span>
                        </div>
                        <h3 class="text-xl font-bold font-plus-jakarta mb-2" style="color: #191c1e;">{{ $item->namakategori }}</h3>
                        <p class="text-sm leading-relaxed mb-8" style="color: #9ca3af;">Kategori untuk mengelompokkan dan mengorganisir aset sesuai kebutuhan.</p>
                        <div class="flex items-center gap-4 pt-6" style="border-top: 1px solid rgba(224, 227, 229, 0.3);">
                            <a href="{{ route('kategori.edit', $item) }}" class="flex items-center gap-2 transition-colors text-sm font-semibold" style="color: #9ca3af;" onmouseover="this.style.color='#4648d4'" onmouseout="this.style.color='#9ca3af'">
                                <span class="material-symbols-outlined text-lg">edit</span>
                                Edit
                            </a>
                            <form action="{{ route('kategori.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kategori {{ $item->namakategori }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-2 transition-colors text-sm font-semibold" style="color: #9ca3af;" onmouseover="this.style.color='#ba1a1a'" onmouseout="this.style.color='#9ca3af'">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4" style="background-color: #eceef0;">
                        <span class="material-symbols-outlined text-4xl" style="color: #9ca3af;">category</span>
                    </div>
                    <h3 class="text-lg font-bold font-plus-jakarta mb-2" style="color: #191c1e;">Tidak ada kategori</h3>
                    <p class="mb-6" style="color: #9ca3af;">Mulai dengan menambahkan kategori baru untuk mengorganisir aset Anda.</p>
                    <a href="{{ route('kategori.create') }}" class="inline-flex items-center gap-2 px-6 py-3 text-white rounded-xl font-bold" style="background: linear-gradient(to right, #4648d4, #8127cf);">
                        <span class="material-symbols-outlined">add</span>
                        Tambah Kategori Pertama
                    </a>
                </div>
            @endforelse

            <!-- Add New Category Placeholder Button -->
            @if($kategoris->count() > 0)
                <a href="{{ route('kategori.create') }}" class="group p-8 rounded-[1.5rem] transition-all duration-300 flex flex-col items-center justify-center text-center" style="border: 2px dashed rgba(199, 196, 215, 0.5); background-color: transparent;" onmouseover="this.style.borderColor='rgba(70, 72, 212, 0.5)'" onmouseout="this.style.borderColor='rgba(199, 196, 215, 0.5)'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-all" style="background-color: #e6e8ea; color: #9ca3af;" onmouseover="this.style.backgroundColor='rgba(70, 72, 212, 0.1)'; this.style.color='#4648d4'" onmouseout="this.style.backgroundColor='#e6e8ea'; this.style.color='#9ca3af'">
                        <span class="material-symbols-outlined text-3xl">add_circle</span>
                    </div>
                    <p class="font-bold transition-colors" style="color: #9ca3af;" onmouseover="this.style.color='#4648d4'" onmouseout="this.style.color='#9ca3af'">Tambah Kategori Baru</p>
                    <p class="text-xs mt-1" style="color: #9ca3af;">Buat segmentasi aset baru</p>
                </a>
            @endif
        </div>

        <!-- Footer Stats -->
        @if($kategoris->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl flex items-center gap-4" style="background: rgba(242, 244, 246, 0.5);">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(70, 72, 212, 0.1); color: #4648d4;">
                        <span class="material-symbols-outlined">grid_view</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold tracking-wider" style="color: #9ca3af;">Total Kategori</p>
                        <p class="text-lg font-bold" style="color: #191c1e;">{{ $kategoris->total() }} Aktif</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>