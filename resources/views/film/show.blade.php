@extends('layouts.app')

@section('isi')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('film.index') }}" class="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center">
                &larr; Kembali ke Katalog Film
            </a>
        </div>

        <x-kartu :judul="$film->judul">
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <span class="px-2.5 py-1 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                        {{ $film->genre }}
                    </span>
                    <span class="px-2.5 py-1 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                        {{ $film->usia_rating }}
                    </span>
                    <span class="text-xs text-slate-500 font-medium">
                        Durasi: {{ $film->durasi_menit }} Menit
                    </span>
                    <span class="text-xs uppercase font-bold text-slate-600 ml-auto">
                        Status: <strong class="text-emerald-600">{{ $film->status_tayang }}</strong>
                    </span>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Sinopsis Lengkap</h4>
                    <p class="text-slate-700 leading-relaxed text-sm bg-slate-50 p-4 rounded-lg border border-slate-100">
                        {{ $film->sinopsis }}
                    </p>
                </div>

                <!-- Jadwal Tayang Terkait (Pertemuan 4 Slide 9) -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Jadwal Tayang di Studio</h4>
                    @if ($film->jadwals->isNotEmpty())
                        <div class="overflow-x-auto border border-slate-200 rounded-lg">
                            <table class="min-w-full divide-y divide-slate-200 text-xs">
                                <thead class="bg-slate-50 text-slate-600">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold">Studio</th>
                                        <th class="px-4 py-2 text-left font-semibold">Tanggal</th>
                                        <th class="px-4 py-2 text-left font-semibold">Jam Mulai</th>
                                        <th class="px-4 py-2 text-left font-semibold">Harga Tiket</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @foreach ($film->jadwals as $j)
                                        <tr>
                                            <td class="px-4 py-2 font-medium text-slate-800">{{ $j->nama_studio }}</td>
                                            <td class="px-4 py-2 text-slate-600">{{ $j->tanggal->format('d M Y') }}</td>
                                            <td class="px-4 py-2 text-slate-600">{{ substr($j->jam_mulai, 0, 5) }} WIB</td>
                                            <td class="px-4 py-2 font-semibold text-emerald-600">Rp {{ number_format($j->harga_tiket, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-xs text-slate-500 italic">Belum ada jadwal tayang untuk film ini.</p>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm">
                    <span class="text-xs text-slate-400">ID Film: #{{ $film->id }}</span>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('film.edit', $film) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg text-xs transition">
                            Ubah Film
                        </a>
                        <form action="{{ route('film.destroy', $film) }}" method="POST" onsubmit="return confirm('Hapus film ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 rounded-lg text-xs transition">
                                Hapus Film
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </x-kartu>
    </div>
@endsection
