<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Data film utama yang realistis
        $koleksiFilm = [
            [
                'judul' => 'Pengabdi Setan 3: Babak Terakhir',
                'genre' => 'Horor',
                'durasi_menit' => 119,
                'usia_rating' => '17+',
                'sinopsis' => 'Keluarga Rini harus menghadapi misteri konspirasi kultus kuno yang berakar di bawah rusun tempat mereka tinggal.',
                'status_tayang' => 'tayang',
            ],
            [
                'judul' => 'Petualangan Sherina 3',
                'genre' => 'Petualangan, Musikal',
                'durasi_menit' => 126,
                'usia_rating' => 'SU',
                'sinopsis' => 'Sherina dan Sadam memimpin ekspedisi konservasi orangutan di belantara Kalimantan.',
                'status_tayang' => 'tayang',
            ],
            [
                'judul' => 'The Architecture of Love',
                'genre' => 'Drama, Romantis',
                'durasi_menit' => 110,
                'usia_rating' => '13+',
                'sinopsis' => 'Dua insan yang melarikan diri dari masa lalu menemukan kembali makna kehidupan di sudut-sudut kota New York.',
                'status_tayang' => 'tayang',
            ],
            [
                'judul' => 'Agak Laen 2',
                'genre' => 'Komedi',
                'durasi_menit' => 115,
                'usia_rating' => '13+',
                'sinopsis' => 'Empat sekawan penjaga rumah hantu terseret ke dalam kasus misteri baru yang jauh lebih konyol.',
                'status_tayang' => 'tayang',
            ],
            [
                'judul' => 'Gundala 2: Putra Petir',
                'genre' => 'Aksi, Pahlawan Super',
                'durasi_menit' => 135,
                'usia_rating' => '13+',
                'sinopsis' => 'Sancaka menghadapi ancaman tatanan kekacauan baru di ibu kota bersama sekutu pahlawan baru.',
                'status_tayang' => 'segera',
            ],
        ];

        // Pastikan ada satu user dummy untuk relasi pemesan
        $userKasir = User::firstOrCreate(
            ['email' => 'kasir@cibo.test'],
            [
                'name' => 'Budi Kasir Loket',
                'password' => bcrypt('password'),
                'peran' => 'kasir',
            ]
        );

        foreach ($koleksiFilm as $dataFilm) {
            $film = Film::create($dataFilm);

            // Buat 2 jadwal tayang per film
            $jadwal1 = Jadwal::create([
                'film_id' => $film->id,
                'nama_studio' => 'Studio 1 Premiere',
                'tanggal' => now()->toDateString(),
                'jam_mulai' => '13:00:00',
                'harga_tiket' => 50000.00,
                'total_kursi' => 40,
            ]);

            $jadwal2 = Jadwal::create([
                'film_id' => $film->id,
                'nama_studio' => 'Studio 2 Reguler',
                'tanggal' => now()->addDay()->toDateString(),
                'jam_mulai' => '16:30:00',
                'harga_tiket' => 40000.00,
                'total_kursi' => 40,
            ]);

            // Buat contoh pemesanan kursi di jadwal 1
            Pemesanan::create([
                'jadwal_id' => $jadwal1->id,
                'user_id' => $userKasir->id,
                'kode_booking' => 'CIBO-' . strtoupper(substr(md5($film->judul . '1'), 0, 6)),
                'nomor_kursi' => 'C05',
                'nama_pemesan' => 'Rian Pratama',
                'total_bayar' => 50000.00,
                'status_bayar' => 'lunas',
            ]);

            Pemesanan::create([
                'jadwal_id' => $jadwal1->id,
                'user_id' => $userKasir->id,
                'kode_booking' => 'CIBO-' . strtoupper(substr(md5($film->judul . '2'), 0, 6)),
                'nomor_kursi' => 'C06',
                'nama_pemesan' => 'Siti Nurhaliza',
                'total_bayar' => 50000.00,
                'status_bayar' => 'lunas',
            ]);
        }

        // 2. Tambahkan 15 data film dummy acak via factory agar paginasi teruji
        Film::factory()
            ->count(15)
            ->has(
                Jadwal::factory()
                    ->count(2)
                    ->has(Pemesanan::factory()->count(2))
            )
            ->create();
    }
}
