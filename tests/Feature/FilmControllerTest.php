<?php

namespace Tests\Feature;

use App\Models\Film;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class FilmControllerTest extends TestCase
{
    public function test_halaman_index_film_disajikan_lewat_inertia_react(): void
    {
        $response = $this->get(route('film.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/index')
            ->has('judul')
            ->has('films.data')
        );
    }

    public function test_halaman_show_film_disajikan_lewat_inertia_react(): void
    {
        $film = Film::first();

        $response = $this->get(route('film.show', $film));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/show')
            ->where('film.id', $film->id)
            ->where('film.judul', $film->judul)
            ->has('film.jadwals')
        );
    }

    public function test_halaman_create_film_disajikan_lewat_inertia_react(): void
    {
        $response = $this->get(route('film.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/create')
            ->has('judul')
        );
    }

    public function test_halaman_edit_film_disajikan_lewat_inertia_react(): void
    {
        $film = Film::first();

        $response = $this->get(route('film.edit', $film));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/edit')
            ->where('film.id', $film->id)
            ->has('judul')
        );
    }

    public function test_store_film_berhasil_menyimpan_data_dan_redirect_ke_index(): void
    {
        $payload = [
            'judul' => 'Film Pengujian P2 React',
            'genre' => 'Animasi',
            'durasi_menit' => 95,
            'usia_rating' => 'SU',
            'sinopsis' => 'Sinopsis pengujian modul P2 utuh di React.',
            'status_tayang' => 'segera',
        ];

        $response = $this->post(route('film.store'), $payload);

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Film baru berhasil ditambahkan.');

        $this->assertDatabaseHas('films', [
            'judul' => 'Film Pengujian P2 React',
        ]);
    }

    public function test_update_film_berhasil_menyimpan_perubahan_dan_redirect(): void
    {
        $film = Film::create([
            'judul' => 'Judul Sebelum Update P2',
            'genre' => 'Petualangan',
            'durasi_menit' => 105,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis lama.',
            'status_tayang' => 'segera',
        ]);

        $response = $this->put(route('film.update', $film), [
            'judul' => 'Judul Setelah Update P2 Sukses',
            'genre' => 'Petualangan',
            'durasi_menit' => 110,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis baru yang valid.',
            'status_tayang' => 'tayang',
        ]);

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Perubahan data film berhasil disimpan.');

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'judul' => 'Judul Setelah Update P2 Sukses',
        ]);
    }

    public function test_destroy_film_menghapus_data_dan_redirect(): void
    {
        $film = Film::create([
            'judul' => 'Film Dihapus P2',
            'genre' => 'Horor',
            'durasi_menit' => 80,
            'usia_rating' => '17+',
            'sinopsis' => 'Film ini untuk pengujian delete P2.',
            'status_tayang' => 'selesai',
        ]);

        $response = $this->delete(route('film.destroy', $film));

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Film berhasil dihapus dari sistem.');

        $this->assertDatabaseMissing('films', [
            'id' => $film->id,
        ]);
    }
}
