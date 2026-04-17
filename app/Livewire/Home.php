<?php

namespace App\Livewire;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedKategori = '';
    public $kategoris = [];
    public $alat;
    public $showPinjamModal = false;
    public $selectedAlatId;
    public array $form = [
        'tglpinjam' => '',
        'qty' => 1
    ];

    public function mount()
    {
        $this->kategoris = Kategori::pluck('namakategori', 'idkategori')->toArray();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedKategori()
    {
        $this->resetPage();
    }

    public function updatedFormTglpinjam()
    {
        $this->validateOnly('form.tglpinjam', [
            'form.tglpinjam' => 'required|date|after_or_equal:today'
        ]);
    }

    public function updatedFormQty()
    {
        $this->validateOnly('form.qty', [
            'form.qty' => 'required|integer|min:1'
        ]);
    }

    public function pinjam($id)
    {
        session(['quick_alat_id' => $id]);
        return redirect()->route('peminjaman.create');
    }

    public function submitPinjam()
    {
        $this->validate([
            'form.tglpinjam' => 'required|date|after_or_equal:today',
            'form.qty' => 'required|integer|min:1'
        ]);

        // Check stock
        $alat = Alat::find($this->selectedAlatId);
        if ($alat->qty < $this->form['qty']) {
            $this->addError('form.qty', 'Insufficient stock');
            return;
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'idalat' => $this->selectedAlatId,
            'tglpinjam' => $this->form['tglpinjam'],
            'qty' => $this->form['qty'],
            'status' => 'pending' // Use enum if available
        ]);

        $this->showPinjamModal = false;
        $this->dispatch('peminjaman-submitted');
    }

    public function render()
    {
        $query = Alat::with('kategori')
            ->where('qty', '>', 0);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('namaalat', 'like', '%' . $this->search . '%')
                  ->orWhere('spesifikasi', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedKategori) {
            $query->where('idkategori', $this->selectedKategori);
        }

        $this->alat = $query->paginate(12);

        return view('livewire.home');
    }
}

