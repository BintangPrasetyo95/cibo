<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Data contoh sebelum terhubung ke basis data (sesuai modul Pertemuan 2).
     *
     * @var array<int, array<string, mixed>>
     */
    private array $dataContoh = [
        [
            'id' => 1,
            'judul' => 'Pengabdi Setan 3',
            'genre' => 'Horor',
            'durasi_menit' => 118,
            'usia_rating' => '17+',
            'sinopsis' => 'Kelanjutan misteri teror ibu yang kembali menghantui keluarga Rini di rusun terbengkalai.',
            'status_tayang' => 'Sedang Tayang',
        ],
        [
            'id' => 2,
            'judul' => 'Petualangan Sherina 3',
            'genre' => 'Petualangan, Musikal',
            'durasi_menit' => 125,
            'usia_rating' => 'SU',
            'sinopsis' => 'Perjalanan baru Sherina dan Sadam menjelajahi keanekaragaman hayati nusantara.',
            'status_tayang' => 'Sedang Tayang',
        ],
        [
            'id' => 3,
            'judul' => 'The Architecture of Love',
            'genre' => 'Drama, Romantis',
            'durasi_menit' => 110,
            'usia_rating' => '13+',
            'sinopsis' => 'Kisah cinta yang tumbuh tak terduga di antara dua orang asing di kota New York.',
            'status_tayang' => 'Segera Tayang',
        ],
    ];

    /**
     * Menampilkan daftar film (Tugas Studio 1).
     */
    public function index()
    {
        return view('film.index', [
            'judul' => 'Katalog Film CIBO',
            'films' => $this->dataContoh,
        ]);
    }

    /**
     * Menampilkan formulir tambah film baru.
     */
    public function create()
    {
        return view('film.create', [
            'judul' => 'Tambah Film Baru',
        ]);
    }

    /**
     * Menyimpan film baru.
     */
    public function store(Request $request)
    {
        return redirect()->route('film.index');
    }

    /**
     * Menampilkan rincian satu film.
     */
    public function show(string $id)
    {
        $film = collect($this->dataContoh)->firstWhere('id', (int) $id);

        if (! $film) {
            abort(404, 'Film tidak ditemukan.');
        }

        return view('film.show', [
            'judul' => $film['judul'],
            'film' => $film,
        ]);
    }

    /**
     * Menampilkan formulir ubah film.
     */
    public function edit(string $id)
    {
        $film = collect($this->dataContoh)->firstWhere('id', (int) $id);

        if (! $film) {
            abort(404, 'Film tidak ditemukan.');
        }

        return view('film.edit', [
            'judul' => 'Ubah Film: ' . $film['judul'],
            'film' => $film,
        ]);
    }

    /**
     * Menyimpan perubahan film.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('film.index');
    }

    /**
     * Menghapus film.
     */
    public function destroy(string $id)
    {
        return redirect()->route('film.index');
    }
}
