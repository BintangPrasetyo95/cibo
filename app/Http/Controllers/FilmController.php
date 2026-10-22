<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class FilmController extends Controller
{
    /**
     * Menampilkan daftar film dengan otorisasi & props 'can' (Pertemuan 7 Slide 21).
     */
    public function index(Request $request)
    {
        $films = Film::with('jadwals')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return Inertia::render('film/index', [
            'judul' => 'Katalog Film CIBO',
            'films' => $films,
            'can' => [
                'tambah' => $request->user()?->can('create', Film::class) ?? false,
            ],
        ]);
    }

    /**
     * Menampilkan formulir tambah film.
     * Dilindungi Gate::authorize (Pertemuan 7 Slide 18 & 19).
     */
    public function create()
    {
        Gate::authorize('create', Film::class);

        return Inertia::render('film/create', [
            'judul' => 'Tambah Film Baru',
        ]);
    }

    /**
     * Menyimpan data film baru.
     * Dilindungi Gate::authorize (Pertemuan 7 Slide 18 & 19).
     */
    public function store(StoreFilmRequest $request)
    {
        Gate::authorize('create', Film::class);

        Film::create($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian film dengan hak akses spesifik data (Pertemuan 7 Slide 21).
     */
    public function show(Request $request, Film $film)
    {
        $film->load('jadwals');

        return Inertia::render('film/show', [
            'judul' => $film->judul,
            'film' => $film,
            'can' => [
                'ubah' => $request->user()?->can('update', $film) ?? false,
                'hapus' => $request->user()?->can('delete', $film) ?? false,
            ],
        ]);
    }

    /**
     * Menampilkan formulir ubah film.
     * Dilindungi Gate::authorize (Pertemuan 7 Slide 18 & 19).
     */
    public function edit(Film $film)
    {
        Gate::authorize('update', $film);

        return Inertia::render('film/edit', [
            'judul' => 'Ubah Film: ' . $film->judul,
            'film' => $film,
        ]);
    }

    /**
     * Menyimpan pembaruan data film.
     * Dilindungi Gate::authorize (Pertemuan 7 Slide 18 & 19).
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        Gate::authorize('update', $film);

        $film->update($request->validated());

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Perubahan data film berhasil disimpan.');
    }

    /**
     * Menghapus film dari sistem.
     * Dilindungi Gate::authorize (Pertemuan 7 Slide 18 & 19).
     */
    public function destroy(Film $film)
    {
        Gate::authorize('delete', $film);

        $film->delete();

        return redirect()
            ->route('film.index')
            ->with('sukses', 'Film berhasil dihapus dari sistem.');
    }
}
