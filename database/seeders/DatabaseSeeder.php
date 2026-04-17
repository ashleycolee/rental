<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asd')
        ]);

        $this->call([
            KategoriSeeder::class,
            AlatSeeder::class,
        ]);

        User::factory()->create([
            'username' => 'petugas1',
            'namalengkap' => 'Petugas 1',
            'identitas' => '1234567891',
            'nohp' => '08123456790',
            'role' => 'petugas',
            'email' => 'petugas1@gmail.com',
            'password' => Hash::make('asd'),
        ]);
    }
}
