<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $baris = ['A', 'B', 'C', 'D', 'E'];
        $nomor = fake()->numberBetween(1, 10);
        $kursi = fake()->randomElement($baris) . $nomor;

        return [
            'jadwal_id' => Jadwal::factory(),
            'user_id' => User::factory(),
            'kode_booking' => 'CIBO-' . strtoupper(fake()->bothify('??###?')),
            'nomor_kursi' => $kursi,
            'nama_pemesan' => fake()->name(),
            'total_bayar' => fake()->randomElement([35000.00, 45000.00, 50000.00, 75000.00]),
            'status_bayar' => 'lunas',
        ];
    }
}
