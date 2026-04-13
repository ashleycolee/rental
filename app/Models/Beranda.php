<?php

use Livewire\Component;
use App\Models\Kategori; // Assuming you have a Kategori model

class Beranda extends Component
{
    public $kategoris = []; // Define it here
    public $selectedKategori = '';

    public function mount()
    {
        // Initialize the data when the component loads
        $this->kategoris = Kategori::pluck('nama', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}