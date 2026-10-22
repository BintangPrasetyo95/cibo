@extends('layouts.app')

@section('isi')
    <div class="max-w-2xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('film.index') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center">
                &larr; Kembali ke Katalog Film
            </a>
        </div>

        <x-kartu :judul="$film['judul']">
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                        {{ $film['genre'] }}
                    </span>
                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                        {{ $film['usia_rating'] }}
                    </span>
                    <span class="text-xs text-slate-400">
                        {{ $film['durasi_menit'] }} Menit
                    </span>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Sinopsis</h4>
                    <p class="text-slate-700 mt-1 leading-relaxed">
                        {{ $film['sinopsis'] }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm">
                    <span class="text-slate-500">
                        Status Penayangan: <strong class="text-emerald-600">{{ $film['status_tayang'] }}</strong>
                    </span>
                    <div class="space-x-3">
                        <a href="{{ route('film.edit', $film['id']) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg text-xs transition">
                            Ubah Film
                        </a>
                    </div>
                </div>
            </div>
        </x-kartu>
    </div>
@endsection
