<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    private User $admin;
    private User $kasir;
    private Film $film;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin@cibo.test'],
            ['name' => 'Admin CIBO', 'password' => bcrypt('password'), 'peran' => 'admin']
        );
        $this->admin->update(['peran' => 'admin']);

        $this->kasir = User::firstOrCreate(
            ['email' => 'kasir@cibo.test'],
            ['name' => 'Kasir CIBO', 'password' => bcrypt('password'), 'peran' => 'kasir']
        );
        $this->kasir->update(['peran' => 'kasir']);

        $this->film = Film::first() ?? Film::factory()->create();
    }

    public function test_admin_boleh_mengakses_halaman_tambah_film(): void
    {
        $response = $this->actingAs($this->admin)->get(route('film.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page->component('film/create'));
    }

    public function test_kasir_ditolak_dengan_galat_403_saat_langsung_membuka_halaman_tambah(): void
    {
        // Pembuktian Pertemuan 7 Slide 30:
        // Masuk sebagai kasir/petugas, lalu ketik langsung alamat yang hanya untuk admin.
        // Hasil yang benar: galat 403 Forbidden!
        $response = $this->actingAs($this->kasir)->get(route('film.create'));

        $response->assertStatus(403);
    }

    public function test_kasir_ditolak_dengan_galat_403_saat_mencoba_store_film(): void
    {
        $response = $this->actingAs($this->kasir)->post(route('film.store'), [
            'judul' => 'Film Ilegal Kasir',
            'genre' => 'Aksi',
            'durasi_menit' => 120,
            'usia_rating' => '13+',
            'sinopsis' => 'Percobaan membobol tanpa izin admin.',
            'status_tayang' => 'segera',
        ]);

        $response->assertStatus(403);
    }

    public function test_kasir_ditolak_dengan_galat_403_saat_mencoba_edit_dan_update_film(): void
    {
        $responseEdit = $this->actingAs($this->kasir)->get(route('film.edit', $this->film));
        $responseEdit->assertStatus(403);

        $responseUpdate = $this->actingAs($this->kasir)->put(route('film.update', $this->film), [
            'judul' => 'Film Ubah Ilegal',
            'genre' => 'Aksi',
            'durasi_menit' => 120,
            'usia_rating' => '13+',
            'sinopsis' => 'Percobaan update tanpa izin admin.',
            'status_tayang' => 'segera',
        ]);
        $responseUpdate->assertStatus(403);
    }

    public function test_kasir_ditolak_dengan_galat_403_saat_mencoba_destroy_film(): void
    {
        $response = $this->actingAs($this->kasir)->delete(route('film.destroy', $this->film));

        $response->assertStatus(403);
    }

    public function test_admin_menerima_prop_can_tambah_true_pada_halaman_index(): void
    {
        $response = $this->actingAs($this->admin)->get(route('film.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/index')
            ->where('can.tambah', true)
        );
    }

    public function test_kasir_menerima_prop_can_tambah_false_pada_halaman_index(): void
    {
        $response = $this->actingAs($this->kasir)->get(route('film.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('film/index')
            ->where('can.tambah', false)
        );
    }
}
