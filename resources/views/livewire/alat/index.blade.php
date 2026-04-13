<?php

use App\Models\Alat;
use App\Models\Kategori;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithPagination, WithFileUploads;

    public $search = '';
    public $kategori_id;
    #[Validate('required|string|max:255')]
    public $namaalat;
    #[Validate('nullable|string')]
    public $spesifikasi;
    #[Validate('nullable|image|max:2048')] // 2MB
    public $gambaralat;
    #[Validate('required|integer|min:0')]
    public $qty;
    #[Validate('required|exists:kategori,idkategori')]
    public $idkategori;
    public $editingId = null;
    public $showModal = false;
    public $isEditing = false;

    public $kategoris;

    public function mount(): void
    {
        $this->kategoris = Kategori::pluck('namakategori', 'idkategori');
    }

    public function updatedShowModal(): void
    {
        if (! $this->showModal) {
            $this->resetForm();
        }
    }

    public function create(): void
    {
        $this->validate();

        $data = $this->formData();

        if ($this->gambaralat) {
            $data['gambaralat'] = $this->gambaralat->store('alat', 'public');
        }

        Alat::create($data);

        $this->showModal = false;
        $this->dispatch('notify', ['message' => 'Alat berhasil ditambahkan!']);
    }

    public function edit($id): void
    {
        $alat = Alat::findOrFail($id);
        $this->editingId = $id;
        $this->isEditing = true;
        $this->namaalat = $alat->namaalat;
        $this->spesifikasi = $alat->spesifikasi;
        $this->qty = $alat->qty;
        $this->idkategori = $alat->idkategori;
        $this->showModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $alat = Alat::findOrFail($this->editingId);
        $data = $this->formData();

        if ($this->gambaralat) {
            // Delete old image
            if ($alat->gambaralat) {
                Storage::disk('public')->delete($alat->gambaralat);
            }
            $data['gambaralat'] = $this->gambaralat->store('alat', 'public');
        }

        $alat->update($data);

        $this->showModal = false;
        $this->dispatch('notify', ['message' => 'Alat berhasil diupdate!']);
    }

    public function delete($id): void
    {
        $alat = Alat::findOrFail($id);
        if ($alat->gambaralat) {
            Storage::disk('public')->delete($alat->gambaralat);
        }
        $alat->delete();

        $this->dispatch('notify', ['message' => 'Alat berhasil dihapus!', 'type' => 'danger']);
    }

    private function formData(): array
    {
        return [
            'namaalat' => $this->namaalat,
            'spesifikasi' => $this->spesifikasi,
            'qty' => $this->qty,
            'idkategori' => $this->idkategori,
        ];
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->isEditing = false;
        $this->namaalat = '';
        $this->spesifikasi = '';
        $this->qty = 0;
        $this->idkategori = '';
        $this->gambaralat = null;
    }

    public function render(): mixed
    {
        $alat = Alat::with('kategori')
            ->when($this->search, fn ($query) => $query->where('namaalat', 'like', '%'.$this->search.'%')
                ->orWhere('spesifikasi', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        $this->kategoris = Kategori::pluck('namakategori', 'idkategori');

        return view('livewire.alat.index', [
            'alat' => $alat
        ]);
    }
}; ?>

<div>
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Alat</h1>
                <p class="mt-2 text-xl text-gray-600">NANUTTTT</p>
            </div>
            <x-primary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Alat
            </x-primary-button>
        </div>
    </div>
        <x-primary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Alat
        </x-primary-button>
    </x-card-header>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spesifikasi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($alat as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->gambaralat)
                                    <img src="{{ Storage::url($item->gambaralat) }}" alt="{{ $item->namaalat }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $item->namaalat }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $item->kategori->namakategori ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->qty == 0)
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold bg-red-100 text-red-800 rounded-full">Habis</span>
                                @elseif($item->qty < 5)
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold bg-orange-100 text-orange-800 rounded-full">{{ $item->qty }}</span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold bg-emerald-100 text-emerald-800 rounded-full">{{ $item->qty }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $item->spesifikasi }}">{{ $item->spesifikasi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button wire:click="edit({{ $item->idalat }})" class="text-indigo-600 hover:text-indigo-900 p-2 hover:bg-indigo-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 1a2.5 2.5 0 01-2.5-2.5V8.5a2.5 2.5 0 012.5-2.5H21a2.5 2.5 0 012.5 2.5v7.5a2.5 2.5 0 01-2.5 2.5h-5" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $item->idalat }})" wire:confirm="Yakin hapus {{ $item->namaalat }}? Ini tidak bisa dibatalkan!" class="text-red-600 hover:text-red-900 p-2 hover:bg-red-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan alat pertama.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($alat->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $alat->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <x-modal wire:model.live="showModal" maxWidth="2xl">
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">
                {{ $isEditing ? 'Edit Alat' : 'Tambah Alat Baru' }}
            </h3>

            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="namaalat" value="Nama Alat" />
                        <x-text-input wire:model="namaalat" id="namaalat" />
                        <x-input-error for="namaalat" />
                    </div>

                    <div>
                        <x-input-label for="idkategori" value="Kategori" />
                        <select wire:model.live="idkategori" id="idkategori" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="idkategori" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="gambaralat" value="Gambar (Opsional)" />
                        <input type="file" wire:model="gambaralat" id="gambaralat" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <x-input-error for="gambaralat" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="spesifikasi" value="Spesifikasi" />
                        <textarea wire:model="spesifikasi" id="spesifikasi" rows="3" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"></textarea>
                        <x-input-error for="spesifikasi" />
                    </div>

                    <div>
                        <x-input-label for="qty" value="Stok" />
                        <x-text-input wire:model="qty" id="qty" type="number" min="0" />
                        <x-input-error for="qty" />
                    </div>
                </div>

                <div class="flex space-x-3 pt-6">
                    <x-secondary-button wire:click="$set('showModal', false)">Batal</x-secondary-button>
                    <x-primary-button type="submit" wire:loading.attr="disabled">
                        {{ $isEditing ? 'Update' : 'Simpan' }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Livewire Styles -->
    @push('scripts')
    <script>
        Livewire.on('notify', (event) => {
            // Simple toast notification (can use Alpine/JS library)
            alert(event.message);
        });
    </script>
    @endpush
</div>

<style>
/* Custom table styles */
.data-table th {
    @apply sticky top-0 z-10 backdrop-blur;
}
</style>

