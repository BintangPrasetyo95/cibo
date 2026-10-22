@extends('layouts.app')

@section('isi')
    <div class="max-w-2xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('film.index') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center">
                &larr; Kembali ke Katalog Film
            </a>
        </div>

        <x-kartu :judul="$judul">
            <form action="{{ route('film.update', $film) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Judul Film -->
                <div>
                    <label for="judul" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Judul Film <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $film->judul) }}"
                        class="w-full border @error('judul') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('judul')
                        <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Genre & Durasi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="genre" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Genre <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="genre" name="genre" value="{{ old('genre', $film->genre) }}"
                            class="w-full border @error('genre') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('genre')
                            <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="durasi_menit" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Durasi (Menit) <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="durasi_menit" name="durasi_menit" value="{{ old('durasi_menit', $film->durasi_menit) }}"
                            class="w-full border @error('durasi_menit') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @error('durasi_menit')
                            <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Rating Usia & Status Tayang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="usia_rating" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Rating Usia <span class="text-rose-500">*</span>
                        </label>
                        <select id="usia_rating" name="usia_rating"
                            class="w-full border @error('usia_rating') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            @foreach (['SU', '13+', '17+', '21+'] as $r)
                                <option value="{{ $r }}" {{ old('usia_rating', $film->usia_rating) == $r ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                        @error('usia_rating')
                            <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_tayang" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Status Penayangan <span class="text-rose-500">*</span>
                        </label>
                        <select id="status_tayang" name="status_tayang"
                            class="w-full border @error('status_tayang') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="segera" {{ old('status_tayang', $film->status_tayang) == 'segera' ? 'selected' : '' }}>Segera Tayang</option>
                            <option value="tayang" {{ old('status_tayang', $film->status_tayang) == 'tayang' ? 'selected' : '' }}>Sedang Tayang</option>
                            <option value="selesai" {{ old('status_tayang', $film->status_tayang) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status_tayang')
                            <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sinopsis -->
                <div>
                    <label for="sinopsis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Sinopsis Film <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="sinopsis" name="sinopsis" rows="4"
                        class="w-full border @error('sinopsis') border-rose-500 bg-rose-50 @else border-slate-300 @enderror rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('sinopsis', $film->sinopsis) }}</textarea>
                    @error('sinopsis')
                        <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-4 border-t border-slate-100 flex justify-end space-x-3">
                    <a href="{{ route('film.index') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-50 transition">
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
