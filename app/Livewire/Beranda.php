<?php

namespace App\Livewire;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Beranda extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedKategori = '';
    public $showPinjamModal = false;
    public $selectedAlatId;
    public $form = [
        'tglpinjam' => '',
        'qty' => 1,
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedKategori' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->form['tglpinjam'] = now()->format('Y-m-d');
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedKategori(): void
    {
        $this->resetPage();
    }

    public function pinjam(int $id): void
    {
        $this->selectedAlatId = $id;
        $this->showPinjamModal = true;
    }

    public function submitPinjam(): void
    {
        $this->validate([
            'form.tglpinjam' => 'required|date',
            'form.qty' => 'required|integer|min:1',
        ], [], [
            'form.tglpinjam' => 'Tanggal pinjam',
            'form.qty' => 'Jumlah',
        ]);

        $alat = Alat::findOrFail($this->selectedAlatId);

        if ($alat->qty < $this->form['qty']) {
            $this->addError('form.qty', 'Stok tidak cukup!');
            return;
        }

        Peminjaman::create([
            'tglpinjam' => $this->form['tglpinjam'],
            'idalat' => $this->selectedAlatId,
            'qty' => $this->form['qty'],
            'iduser' => auth()->id(),
            'status' => 'menunggu',
        ]);

        $this->showPinjamModal = false;
        $this->resetForm();
        $this->dispatchBrowserEvent('notify', ['message' => 'Permintaan peminjaman berhasil dikirim! Menunggu persetujuan.', 'type' => 'success']);
    }

    private function resetForm(): void
    {
        $this->form = [
            'tglpinjam' => now()->format('Y-m-d'),
            'qty' => 1,
        ];
        $this->selectedAlatId = null;
    }

    public function render(): mixed
    {
        $kategoris = Kategori::pluck('namakategori', 'idkategori');
        $alat = Alat::with('kategori')
            ->when($this->search, fn($query) => $query->where('namaalat', 'like', '%'.$this->search.'%')
                ->orWhere('spesifikasi', 'like', '%'.$this->search.'%'))
            ->when($this->selectedKategori, fn($query) => $query->where('idkategori', $this->selectedKategori))
            ->latest()
            ->paginate(12);

        return view('livewire.beranda', compact('kategoris', 'alat'));
    }
}
