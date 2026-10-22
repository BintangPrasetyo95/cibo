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
        // Admin default
        User::firstOrCreate(
            ['email' => 'admin@cibo.test'],
            [
                'name' => 'Administrator CIBO',
                'password' => bcrypt('password'),
            ]
        );

        // Panggil seeder 3 modul film, jadwal, dan pemesanan
        $this->call([
            FilmSeeder::class,
        ]);
    }
}
