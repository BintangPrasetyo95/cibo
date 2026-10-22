<?php

namespace Tests\Feature;

use Tests\TestCase;

class FilmControllerTest extends TestCase
{
    public function test_halaman_index_film_dapat_dibuka_dan_menampilkan_data_contoh(): void
    {
        $response = $this->get(route('film.index'));

        $response->assertStatus(200);
        $response->assertViewIs('film.index');
        $response->assertSee('Katalog Film CIBO');
        $response->assertSee('Pengabdi Setan 3');
        $response->assertSee('Petualangan Sherina 3');
    }

    public function test_halaman_tambah_film_dapat_dibuka(): void
    {
        $response = $this->get(route('film.create'));

        $response->assertStatus(200);
        $response->assertViewIs('film.create');
        $response->assertSee('Tambah Film Baru');
    }

    public function test_halaman_show_film_dapat_dibuka(): void
    {
        $response = $this->get(route('film.show', 1));

        $response->assertStatus(200);
        $response->assertViewIs('film.show');
        $response->assertSee('Pengabdi Setan 3');
    }

    public function test_halaman_edit_film_dapat_dibuka(): void
    {
        $response = $this->get(route('film.edit', 1));

        $response->assertStatus(200);
        $response->assertViewIs('film.edit');
        $response->assertSee('Pengabdi Setan 3');
    }

    public function test_show_mengembalikan_404_jika_film_tidak_ada(): void
    {
        $response = $this->get(route('film.show', 999));

        $response->assertStatus(404);
    }
}
