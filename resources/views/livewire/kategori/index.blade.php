<?php

use App\Models\Kategori;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithPagination;

    public $search = '';
    #[Validate('required|string|max:255|unique:kategori,namakategori')]
    public $namakategori;
    public $editingId = null;
    public $showModal = false;
    public $isEditing = false;

    public function updatedShowModal(): void
    {
        if (! $this->showModal) {
            $this->resetForm();
        }
    }

    public function create(): void
    {
        $this->validate();

        Kategori::create(['namakategori' => $this->namakategori]);

        $this->showModal = false;
        $this->dispatch('notify', ['message' => 'Kategori berhasil ditambahkan!']);
    }

    public function edit($id): void
    {
        $kategori = Kategori::findOrFail($id);
        $this->editingId = $id;
        $this->isEditing = true;
        $this->namakategori = $kategori->namakategori;
        $this->showModal = true;
    }

    public function update(): void
    {
        $this->validate([
            'namakategori' => 'required|string|max:255|unique:kategori,namakategori,' . $this->editingId,
        ]);

        $kategori = Kategori::findOrFail($this->editingId);
        $kategori->update(['namakategori' => $this->namakategori]);

        $this->showModal = false;
        $this->dispatch('notify', ['message' => 'Kategori berhasil diupdate!']);
    }

    public function delete($id): void
    {
        Kategori::findOrFail($id)->delete();
        $this->dispatch('notify', ['message' => 'Kategori berhasil dihapus!', 'type' => 'danger']);
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->isEditing = false;
        $this->namakategori = '';
    }

    public function render(): \Illuminate\View\View
    {
        $kategoris = Kategori::when($this->search, fn ($query) => $query->where('namakategori', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.kategori.index', [
            'kategoris' => $kategoris
        ]);
    }
}; ?>

<div>
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Kategori</h1>
                <p class="mt-2 text-xl text-gray-600">Manajemen kategori alat</p>
            </div>
            <x-primary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kategori
            </x-primary-button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Alat</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kategoris as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->namakategori }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-800 rounded-full">
                                    {{ $item->alat()->count() }} alat
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button wire:click="edit({{ $item->idkategori }})" class="text-indigo-600 hover:text-indigo-900 p-2 hover:bg-indigo-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 1a2.5 2.5 0 01-2.5-2.5V8.5a2.5 2.5 0 012.5-2.5H21a2.5 2.5 0 012.5 2.5v7.5a2.5 2.5 0 01-2.5 2.5h-5" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $item->idkategori }})" wire:confirm="Yakin hapus kategori '{{ $item->namakategori }}'? Alat terkait akan kehilangan referensi!" class="text-red-600 hover:text-red-900 p-2 hover:bg-red-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kategori</h3>
                                <p class="mt-1 text-sm text-gray-500">Tambahkan kategori pertama untuk mengorganisir alat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kategoris->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <x-modal wire:model.live="showModal">
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">
                {{ $isEditing ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
            </h3>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                <div class="space-y-4">
                    <div>
                        <x-input-label for="namakategori" value="Nama Kategori" />
                        <x-text-input wire:model="namakategori" id="namakategori" />
                        <x-input-error for="namakategori" />
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
</div>

