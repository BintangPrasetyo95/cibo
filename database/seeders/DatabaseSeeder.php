<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database (Pertemuan 7 Slide 20).
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@cibo.test'],
            [
                'name' => 'Administrator CIBO',
                'password' => bcrypt('password'),
                'peran' => 'admin',
            ]
        );

        // 2. Akun Petugas Loket / Kasir
        User::updateOrCreate(
            ['email' => 'kasir@cibo.test'],
            [
                'name' => 'Kasir Loket Bioskop',
                'password' => bcrypt('password'),
                'peran' => 'kasir',
            ]
        );

        // 3. Panggil Seeder Film, Jadwal, dan Pemesanan
        $this->call([
            FilmSeeder::class,
        ]);
    }
}
