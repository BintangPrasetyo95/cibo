@extends('layouts.app')

@section('isi')
    <div class="max-w-xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('film.index') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center">
                &larr; Kembali ke Katalog Film
            </a>
        </div>

        <x-kartu :judul="$judul">
            <form action="{{ route('film.update', $film['id']) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="judul" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Judul Film</label>
                    <input type="text" id="judul" name="judul" value="{{ $film['judul'] }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="genre" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Genre</label>
                        <input type="text" id="genre" name="genre" value="{{ $film['genre'] }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    </div>
                    <div>
                        <label for="durasi_menit" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Durasi (Menit)</label>
                        <input type="number" id="durasi_menit" name="durasi_menit" value="{{ $film['durasi_menit'] }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <a href="{{ route('film.index') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold shadow-sm transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </x-kartu>
    </div>
@endsection
