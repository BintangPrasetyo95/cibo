@extends('layouts.app')

@section('isi')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">{{ $judul }}</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar film aktif dari basis data PostgreSQL dengan paginasi.</p>
        </div>
        <a href="{{ route('film.create') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition">
            + Tambah Film Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($films as $f)
            <x-kartu :judul="$f->judul">
                <div class="space-y-3 text-sm flex flex-col justify-between h-full">
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                                {{ $f->genre }}
                            </span>
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                                {{ $f->usia_rating }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ $f->durasi_menit }} Menit
                            </span>
                        </div>

                        <p class="text-slate-600 line-clamp-3">
                            {{ $f->sinopsis }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-medium text-slate-500">
                                Status: <strong class="text-emerald-600 uppercase">{{ $f->status_tayang }}</strong>
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ $f->jadwals->count() }} Jadwal Tayang
                            </span>
                        </div>

                        <!-- Aksi Show, Edit, Destroy dengan Tautan Bernama & Pola REST (Pertemuan 4 Slide 18) -->
                        <div class="flex items-center justify-between pt-2 border-t border-slate-50 text-xs">
                            <div class="space-x-3">
                                <a href="{{ route('film.show', $f) }}" class="text-blue-600 hover:underline font-semibold">
                                    Rincian
                                </a>
                                <a href="{{ route('film.edit', $f) }}" class="text-amber-600 hover:underline font-semibold">
                                    Ubah
                                </a>
                            </div>

                            <form action="{{ route('film.destroy', $f) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:underline font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </x-kartu>
        @empty
            <div class="col-span-full bg-white border border-dashed border-slate-300 rounded-xl p-12 text-center text-slate-500">
                <p class="text-lg font-medium text-slate-700 mb-1">Belum ada data film di basis data.</p>
                <p class="text-sm mb-4">Silakan tambahkan data film pertama untuk memulai.</p>
                <a href="{{ route('film.create') }}" class="text-emerald-600 font-semibold hover:underline">
                    + Tambah Film Sekarang
                </a>
            </div>
        @endforelse
    </div>

    <!-- Paginasi (Pertemuan 4 Slide 9) -->
    <div class="mt-8">
        {{ $films->links() }}
    </div>
@endsection
