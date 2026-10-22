<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $studios = ['Studio 1 Premiere', 'Studio 2 Reguler', 'Studio 3 IMAX', 'Studio 4 Dolby Atmos'];
        $hargaOptions = [35000.00, 45000.00, 50000.00, 75000.00, 100000.00];

        return [
            'film_id' => Film::factory(),
            'nama_studio' => fake()->randomElement($studios),
            'tanggal' => fake()->dateTimeBetween('now', '+2 weeks')->format('Y-m-d'),
            'jam_mulai' => fake()->randomElement(['12:30:00', '14:45:00', '17:15:00', '19:30:00', '21:45:00']),
            'harga_tiket' => fake()->randomElement($hargaOptions),
            'total_kursi' => 40,
        ];
    }
}
