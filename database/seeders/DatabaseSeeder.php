<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'namalengkap' => 'Admin Peminjaman',
            'identitas' => '1234567890',
            'nohp' => '08123456789',
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@peminjaman.app',
        ]);

        $this->call(KategoriSeeder::class);

        User::factory()->create([
            'username' => 'petugas1',
            'namalengkap' => 'Petugas 1',
            'identitas' => '1234567891',
            'nohp' => '08123456790',
            'role' => 'petugas',
            'name' => 'Petugas 1',
            'email' => 'petugas1@peminjaman.app',
            'password' => bcrypt('password123'),
        ]);
    }
}
