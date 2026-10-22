<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Menampilkan daftar seluruh film dengan paginasi dan eager loading (Pertemuan 4 Slide 9).
     */
    public function index()
    {
        $films = Film::with('jadwals')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('film.index', [
            'judul' => 'Katalog Film CIBO',
            'films' => $films,
        ]);
    }

    /**
     * Menampilkan formulir tambah film baru (Pertemuan 4 Slide 10).
     */
    public function create()
    {
        return view('film.create', [
            'judul' => 'Tambah Film Baru',
        ]);
    }

    /**
     * Menyimpan data film baru dengan validasi Form Request & POST-Redirect-GET (Pertemuan 4 Slide 11 & 18).
     */
    public function store(StoreFilmRequest $request)
    {
        Film::create($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian film menggunakan Route Model Binding (Pertemuan 4 Slide 6 & 9).
     */
    public function show(Film $film)
    {
        $film->load('jadwals');

        return view('film.show', [
            'judul' => $film->judul,
            'film' => $film,
        ]);
    }

    /**
     * Menampilkan formulir ubah film (Pertemuan 4 Slide 8).
     */
    public function edit(Film $film)
    {
        return view('film.edit', [
            'judul' => 'Ubah Film: ' . $film->judul,
            'film' => $film,
        ]);
    }

    /**
     * Menyimpan pembaruan data film (Pertemuan 4 Slide 18).
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $film->update($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Perubahan data film berhasil disimpan.');
    }

    /**
     * Menghapus film dan mengalihkan dengan pesan flash (Pertemuan 4 Slide 18).
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film berhasil dihapus dari sistem.');
    }
}
