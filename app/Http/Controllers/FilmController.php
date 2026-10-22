<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use Inertia\Inertia;

class FilmController extends Controller
{
    /**
     * Menampilkan daftar seluruh film dengan paginasi melalui React Inertia (Pertemuan 6 Slide 29 & 30).
     */
    public function index()
    {
        $films = Film::with('jadwals')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return Inertia::render('film/index', [
            'judul' => 'Katalog Film CIBO',
            'films' => $films,
        ]);
    }

    /**
     * Menampilkan formulir tambah film baru melalui React Inertia (Pertemuan 6 Slide 29 & 30).
     */
    public function create()
    {
        return Inertia::render('film/create', [
            'judul' => 'Tambah Film Baru',
        ]);
    }

    /**
     * Menyimpan data film baru dengan validasi Form Request & POST-Redirect-GET.
     */
    public function store(StoreFilmRequest $request)
    {
        Film::create($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian film melalui React Inertia (Pertemuan 6 Slide 29 & 30).
     */
    public function show(Film $film)
    {
        $film->load('jadwals');

        return Inertia::render('film/show', [
            'judul' => $film->judul,
            'film' => $film,
        ]);
    }

    /**
     * Menampilkan formulir ubah film melalui React Inertia (Pertemuan 6 Slide 29 & 30).
     */
    public function edit(Film $film)
    {
        return Inertia::render('film/edit', [
            'judul' => 'Ubah Film: ' . $film->judul,
            'film' => $film,
        ]);
    }

    /**
     * Menyimpan pembaruan data film.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $film->update($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Perubahan data film berhasil disimpan.');
    }

    /**
     * Menghapus film dan mengalihkan dengan pesan flash.
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film berhasil dihapus dari sistem.');
    }
}
