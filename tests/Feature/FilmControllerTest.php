<?php

namespace Tests\Feature;

use App\Models\Film;
use Tests\TestCase;

class FilmControllerTest extends TestCase
{
    public function test_halaman_index_film_dapat_dibuka_dari_basis_data(): void
    {
        $film = Film::orderBy('id', 'desc')->first();

        $response = $this->get(route('film.index'));

        $response->assertStatus(200);
        $response->assertViewIs('film.index');
        $response->assertSee('Katalog Film CIBO');
        if ($film) {
            $response->assertSee($film->judul);
        }
    }

    public function test_halaman_tambah_film_dapat_dibuka(): void
    {
        $response = $this->get(route('film.create'));

        $response->assertStatus(200);
        $response->assertViewIs('film.create');
        $response->assertSee('Tambah Film Baru');
    }

    public function test_halaman_show_film_menggunakan_route_model_binding(): void
    {
        $film = Film::first();

        $response = $this->get(route('film.show', $film));

        $response->assertStatus(200);
        $response->assertViewIs('film.show');
        $response->assertSee($film->judul);
    }

    public function test_halaman_edit_film_dapat_dibuka(): void
    {
        $film = Film::first();

        $response = $this->get(route('film.edit', $film));

        $response->assertStatus(200);
        $response->assertViewIs('film.edit');
        $response->assertSee($film->judul);
    }

    public function test_store_film_berhasil_dengan_pola_post_redirect_get_dan_pesan_flash(): void
    {
        $payload = [
            'judul' => 'Film Uji Coba Baru',
            'genre' => 'Aksi',
            'durasi_menit' => 110,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis pengujian otomatis untuk memverifikasi pola PRG.',
            'status_tayang' => 'segera',
        ];

        $response = $this->post(route('film.store'), $payload);

        // POST-Redirect-GET: Harus redirect, bukan return view
        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Film baru berhasil ditambahkan.');

        $this->assertDatabaseHas('films', [
            'judul' => 'Film Uji Coba Baru',
        ]);
    }

    public function test_store_film_gagal_validasi_mengembalikan_galat_dan_isian_lama(): void
    {
        // Kirim data kosong yang melanggar aturan required
        $response = $this->post(route('film.store'), [
            'judul' => '',
            'genre' => '',
        ]);

        $response->assertSessionHasErrors(['judul', 'genre', 'durasi_menit', 'usia_rating', 'sinopsis', 'status_tayang']);
        $response->assertRedirect();
    }

    public function test_update_film_berhasil_menyimpan_perubahan(): void
    {
        $film = Film::create([
            'judul' => 'Film Sebelum Diedit',
            'genre' => 'Drama',
            'durasi_menit' => 95,
            'usia_rating' => 'SU',
            'sinopsis' => 'Sinopsis sebelum diedit.',
            'status_tayang' => 'segera',
        ]);

        $response = $this->put(route('film.update', $film), [
            'judul' => 'Film Setelah Diedit Sukses',
            'genre' => 'Drama',
            'durasi_menit' => 100,
            'usia_rating' => '13+',
            'sinopsis' => 'Sinopsis yang sudah diperbarui.',
            'status_tayang' => 'tayang',
        ]);

        $response->assertRedirect(route('film.index'));
        $response->assertSessionHas('sukses', 'Perubahan data film berhasil disimpan.');

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'judul' => 'Film Setelah Diedit Sukses',
        ]);
    }

    public function test_destroy_film_menghapus_data_dan_redirect_dengan_flash(): void
    {
        $film = Film::create([
            'judul' => 'Film Untuk Dihapus',
            'genre' => 'Horor',
            'durasi_menit' => 88,
            'usia_rating' => '17+',
            'sinopsis' => 'Film ini dibuat khusus untuk diuji penghapusannya.',
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
