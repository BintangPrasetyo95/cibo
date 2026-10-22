<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AuthenticationFlowTest extends TestCase
{
    public function test_halaman_login_dapat_dibuka_oleh_tamu(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page->component('auth/login'));
    }

    public function test_pengguna_dapat_masuk_dengan_kredensial_valid(): void
    {
        $user = User::factory()->create([
            'email' => 'pengguna.uji@cibo.test',
            'password' => Hash::make('password123'),
            'peran' => 'kasir',
        ]);

        $response = $this->post('/login', [
            'email' => 'pengguna.uji@cibo.test',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('film.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_masuk_gagal_jika_kata_sandi_salah(): void
    {
        $user = User::factory()->create([
            'email' => 'pengguna.salah@cibo.test',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from(route('login'))->post('/login', [
            'email' => 'pengguna.salah@cibo.test',
            'password' => 'katasandisalah',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_halaman_register_dapat_dibuka_oleh_tamu(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page->component('auth/register'));
    }

    public function test_pendaftaran_akun_baru_berhasil_dan_langsung_masuk_ke_sistem(): void
    {
        $response = $this->post('/register', [
            'name' => 'Calon Kasir Cibo',
            'email' => 'kasir.baru@cibo.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'peran' => 'kasir',
        ]);

        $response->assertRedirect(route('film.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'kasir.baru@cibo.test',
            'peran' => 'kasir',
        ]);

        $user = User::where('email', 'kasir.baru@cibo.test')->first();
        $this->assertAuthenticatedAs($user);
    }

    public function test_pendaftaran_gagal_jika_konfirmasi_kata_sandi_tidak_cocok(): void
    {
        $response = $this->from(route('register'))->post('/register', [
            'name' => 'Calon Kasir Gagal',
            'email' => 'kasir.gagal@cibo.test',
            'password' => 'password123',
            'password_confirmation' => 'berbeda456',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_pengguna_dapat_keluar_sistem_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('film.index'));
        $this->assertGuest();
    }
}
