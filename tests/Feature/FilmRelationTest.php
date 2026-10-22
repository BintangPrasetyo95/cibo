<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use Carbon\CarbonInterface;
use Tests\TestCase;

class FilmRelationTest extends TestCase
{
    public function test_relasi_film_memiliki_banyak_jadwal(): void
    {
        $film = Film::with('jadwals')->first();

        $this->assertNotNull($film);
        $this->assertTrue($film->jadwals->isNotEmpty());
        $this->assertInstanceOf(Jadwal::class, $film->jadwals->first());
    }

    public function test_relasi_jadwal_milik_satu_film_dan_memiliki_banyak_pemesanan(): void
    {
        $jadwal = Jadwal::with(['film', 'pemesanans'])->first();

        $this->assertNotNull($jadwal);
        $this->assertInstanceOf(Film::class, $jadwal->film);
        $this->assertInstanceOf(CarbonInterface::class, $jadwal->tanggal);
    }

    public function test_relasi_pemesanan_milik_satu_jadwal(): void
    {
        $pemesanan = Pemesanan::with('jadwal.film')->first();

        $this->assertNotNull($pemesanan);
        $this->assertInstanceOf(Jadwal::class, $pemesanan->jadwal);
        $this->assertInstanceOf(Film::class, $pemesanan->jadwal->film);
    }

    public function test_pencarian_case_insensitive_postgresql_ilike(): void
    {
        // Pastikan film dengan judul 'Pengabdi' dapat ditemukan dengan huruf kecil 'pengabdi'
        $hasil = Film::where('judul', 'ILIKE', '%pengabdi%')->get();

        $this->assertTrue($hasil->isNotEmpty());
        $this->assertStringContainsStringIgnoringCase('pengabdi', $hasil->first()->judul);
    }
}
