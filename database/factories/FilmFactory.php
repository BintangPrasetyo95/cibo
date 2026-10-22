<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Aksi', 'Horor', 'Drama', 'Komedi', 'Petualangan', 'Animasi', 'Thriller', 'Romantis'];
        $ratings = ['SU', '13+', '17+', '21+'];
        $statuses = ['segera', 'tayang', 'selesai'];

        return [
            'judul' => fake()->sentence(3, true),
            'genre' => fake()->randomElement($genres),
            'durasi_menit' => fake()->numberBetween(85, 180),
            'usia_rating' => fake()->randomElement($ratings),
            'sinopsis' => fake()->paragraph(3),
            'status_tayang' => fake()->randomElement($statuses),
        ];
    }
}
