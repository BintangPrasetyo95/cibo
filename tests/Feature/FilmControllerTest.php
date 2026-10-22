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

    public function test_halaman_tambah_film_tetap_blade_pada_pertemuan_5(): void
    {
        $response = $this->get(route('film.create'));

        $response->assertStatus(200);
        $response->assertViewIs('film.create');
        $response->assertSee('Tambah Film Baru');
    }

    public function test_halaman_edit_film_tetap_blade_pada_pertemuan_5(): void
    {
        $film = Film::first();

        $response = $this->get(route('film.edit', $film));

        $response->assertStatus(200);
        $response->assertViewIs('film.edit');
        $response->assertSee('Ubah Film: ' . $film->judul);
    }

    public function test_store_film_berhasil_menyimpan_data_dan_redirect_ke_index(): void
    {
        $payload = [
            'judul' => 'Film Pengujian Inertia',
            'genre' => 'Animasi',
            'durasi_menit' => 90,
            'usia_rating' => 'SU',
            'sinopsis' => 'Sinopsis pengujian integrasi Inertia dan Form Request.',
            'status_tayang' => 'segera',
        ];

        $response = $this->post(route('film.store'), $payload);

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Film baru berhasil ditambahkan.');

        $this->assertDatabaseHas('films', [
            'judul' => 'Film Pengujian Inertia',
        ]);
    }

    public function test_update_film_berhasil_menyimpan_perubahan_dan_redirect(): void
    {
        $film = Film::create([
            'judul' => 'Judul Sebelum Update Inertia',
            'genre' => 'Petualangan',
            'durasi_menit' => 105,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis lama.',
            'status_tayang' => 'segera',
        ]);

        $response = $this->put(route('film.update', $film), [
            'judul' => 'Judul Setelah Update Inertia Sukses',
            'genre' => 'Petualangan',
            'durasi_menit' => 110,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis baru.',
            'status_tayang' => 'tayang',
        ]);

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Perubahan data film berhasil disimpan.');

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'judul' => 'Judul Setelah Update Inertia Sukses',
        ]);
    }

    public function test_destroy_film_menghapus_data_dan_redirect(): void
    {
        $film = Film::create([
            'judul' => 'Film Dihapus Inertia',
            'genre' => 'Horor',
            'durasi_menit' => 80,
            'usia_rating' => '17+',
            'sinopsis' => 'Film ini untuk pengujian delete.',
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
