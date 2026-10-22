import React, { useState } from 'react';
import { Link } from '@inertiajs/react';
import Kartu from '@/components/Kartu';

export default function BarisFilm({ film }) {
    // Kaidah State 4: Taruh state serendah mungkin (Pertemuan 6 Slide 13 & 15)
    const [konfirmasi, setKonfirmasi] = useState(false);

    return (
        <Kartu className="flex flex-col justify-between h-full">
            <div>
                <div className="flex flex-wrap items-center gap-2 mb-2">
                    <span className="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                        {film.genre}
                    </span>
                    <span className="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                        {film.usia_rating}
                    </span>
                    <span className="text-xs text-slate-400">
                        {film.durasi_menit} Menit
                    </span>
                </div>

                <h3 className="font-bold text-xl text-slate-800 mb-2">
                    {film.judul}
                </h3>

                <p className="text-slate-600 text-sm line-clamp-3">
                    {film.sinopsis}
                </p>
            </div>

            <div className="pt-4 mt-4 border-t border-slate-100 space-y-2 text-xs">
                <div className="flex justify-between items-center">
                    <span className="font-medium text-slate-500">
                        Status: <strong className="text-emerald-600 uppercase">{film.status_tayang}</strong>
                    </span>
                    <span className="text-slate-400">
                        {film.jadwals ? film.jadwals.length : 0} Jadwal Tayang
                    </span>
                </div>

                <div className="flex items-center justify-between pt-2 border-t border-slate-50">
                    <div className="space-x-3">
                        <Link
                            href={`/film/${film.id}`}
                            className="text-blue-600 hover:underline font-semibold"
                        >
                            Rincian &rarr;
                        </Link>
                        <Link
                            href={`/film/${film.id}/edit`}
                            className="text-amber-600 hover:underline font-semibold"
                        >
                            Ubah
                        </Link>
                    </div>

                    {/* Konfirmasi Hapus Interaktif via State Lokal (Pertemuan 6 Slide 13 & 14) */}
                    <div>
                        {konfirmasi ? (
                            <div className="flex items-center space-x-2 bg-rose-50 px-2 py-1 rounded border border-rose-200">
                                <span className="text-rose-700 font-medium">Yakin?</span>
                                <Link
                                    href={`/film/${film.id}`}
                                    method="delete"
                                    as="button"
                                    className="text-white bg-rose-600 hover:bg-rose-700 px-2 py-0.5 rounded font-bold transition"
                                >
                                    Ya
                                </Link>
                                <button
                                    type="button"
                                    onClick={() => setKonfirmasi(false)}
                                    className="text-slate-500 hover:text-slate-700 underline"
                                >
                                    Batal
                                </button>
                            </div>
                        ) : (
                            <button
                                type="button"
                                onClick={() => setKonfirmasi(true)}
                                className="text-rose-600 hover:text-rose-800 hover:underline font-semibold"
                            >
                                Hapus
                            </button>
                        )}
                    </div>
                </div>
            </div>
        </Kartu>
    );
}
