<?php

use App\Enums\PeminjamanStatus;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithPagination;

    public $search = '';
    #[Validate(['tglpinjam' => 'required|date', 'tglkembali' => 'nullable|date|after:tglpinjam', 'idalat' => 'required|exists:alat,idalat', 'qty' => 'required|integer|min:1', 'kondisiakhir' => 'nullable|string', 'status' => 'in:menunggu,disetujui,dipinjam,dikembalikan'])]
    public $form = [
        'tglpinjam' => '',
        'tglkembali' => '',
        'idalat' => '',
        'qty' => 1,
        'kondisiakhir' => '',
        'status' => 'menunggu',
    ];

    public $editingId;
    public $showModal = false;
    public $isEditing = false;
    public $alats;
    public $users;

    public function mount(): void
    {
        $this->alats = Alat::with('kategori')->get();
        $this->users = User::pluck('namalengkap', 'id');
    }

    public function create(): void
    {
        $this->validate();

        $alat = Alat::find($this->form['idalat']);
        if ($alat->qty < $this->form['qty']) {
            $this->addError('qty', 'Stok tidak mencukupi!');
            return;
        }

        Peminjaman::create($this->form);

        $this->showModal = false;
        $this->dispatch('notify', ['message' => 'Peminjaman berhasil dibuat!']);
        $this->resetForm();
    }

    // Similar edit/update/delete methods...

    public function approve($id): void
    {
        $pinjam = Peminjaman::findOrFail($id);
        if ($pinjam->status !== 'menunggu') return;

        $pinjam->update(['status' => 'disetujui']);
        $this->dispatch('notify', ['message' => 'Peminjaman disetujui!']);
    }

    public function return($id): void
    {
        $pinjam = Peminjaman::findOrFail($id);
        if ($pinjam->status !== 'dipinjam') return;

        $alat = Alat::find($pinjam->idalat);
        $alat->increment('qty', $pinjam->qty);

        $pinjam->update(['status' => 'dikembalikan', 'tglkembali' => now()]);
        $this->dispatch('notify', ['message' => 'Peminjaman dikembalikan! Stok ditambah.']);
    }

    private function resetForm(): void
    {
        $this->form = [
            'tglpinjam' => '',
            'tglkembali' => '',
            'idalat' => '',
            'qty' => 1,
            'kondisiakhir' => '',
            'status' => 'menunggu',
        ];
        $this->editingId = null;
        $this->isEditing = false;
    }

    public function render(): \Illuminate\View\View
    {
        $peminjaman = Peminjaman::with(['alat.kategori', 'user'])
            ->when($this->search, fn ($query) => $query->whereHas('alat', fn ($q) => $q->where('namaalat', 'like', '%'.$this->search.'%'))
                ->orWhereHas('user', fn ($q) => $q->where('namalengkap', 'like', '%'.$this->search.'%')))
            ->latest()
            ->paginate(10);

        return view('livewire.peminjaman.index', compact('peminjaman'));
    }
}; ?>

<div>
    <!-- Similar UI as Alat but with status badges and action buttons (Approve/Return) -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manajemen Peminjaman</h1>
                <p class="mt-2 text-xl text-gray-600">Pinjam, approve, return dengan manajemen stok otomatis</p>
            </div>
            <x-primary-button wire:click="$toggle('showModal')">
                Tambah Peminjaman
            </x-primary-button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table with status colored badges, approve/return buttons -->
    </div>
</div>

