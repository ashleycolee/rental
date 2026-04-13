<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Komputer & Laptop',
            'Kamera & Fotografi',
            'Audio & Video',
            'Alat Kantor',
            'Olahraga & Outdoor',
            'Lab Elektronika',
            'Lab Kimia',
            'Alat Mekanik',
        ];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate(['namakategori' => $nama]);
        }
    }
}

