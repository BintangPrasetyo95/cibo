import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';

export default function Show({ film, judul }) {
    // Kaidah State: Konfirmasi sebelum menghapus (Pertemuan 6 Slide 13 & 30)
    const [konfirmasi, setKonfirmasi] = useState(false);

    return (
        <AppLayout>
            <Head title={film.judul} />

            <div className="max-w-3xl mx-auto">
                <div className="mb-4">
                    <Link
                        href="/film"
                        className="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center"
                    >
                        &larr; Kembali ke Katalog Film
                    </Link>
                </div>

                <div className="border border-slate-200 rounded-xl p-8 bg-white shadow-sm space-y-6">
                    <div className="border-b border-slate-100 pb-4">
                        <div className="flex flex-wrap items-center gap-2 mb-2">
                            <span className="px-2.5 py-1 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                                {film.genre}
                            </span>
                            <span className="px-2.5 py-1 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                                {film.usia_rating}
                            </span>
                            <span className="text-xs text-slate-500 font-medium">
                                Durasi: {film.durasi_menit} Menit
                            </span>
                            <span className="text-xs uppercase font-bold text-slate-600 ml-auto">
                                Status: <strong className="text-emerald-600">{film.status_tayang}</strong>
                            </span>
                        </div>

                        <h1 className="text-3xl font-extrabold text-slate-900 mt-2">
                            {film.judul}
                        </h1>
                    </div>

                    <div>
                        <h4 className="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">
                            Sinopsis Film
                        </h4>
                        <p className="text-slate-700 leading-relaxed text-sm bg-slate-50 p-4 rounded-lg border border-slate-100">
                            {film.sinopsis}
                        </p>
                    </div>

                    {/* Jadwal Tayang Terkait */}
                    <div>
                        <h4 className="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">
                            Jadwal Tayang Studio Terdaftar
                        </h4>
                        {film.jadwals && film.jadwals.length > 0 ? (
                            <div className="overflow-x-auto border border-slate-200 rounded-lg">
                                <table className="min-w-full divide-y divide-slate-200 text-xs">
                                    <thead className="bg-slate-50 text-slate-600">
                                        <tr>
                                            <th className="px-4 py-2.5 text-left font-semibold">Studio</th>
                                            <th className="px-4 py-2.5 text-left font-semibold">Tanggal</th>
                                            <th className="px-4 py-2.5 text-left font-semibold">Jam Mulai</th>
                                            <th className="px-4 py-2.5 text-left font-semibold">Harga Tiket</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-slate-100 bg-white">
                                        {film.jadwals.map((j) => (
                                            <tr key={j.id} className="hover:bg-slate-50">
                                                <td className="px-4 py-2.5 font-medium text-slate-800">{j.nama_studio}</td>
                                                <td className="px-4 py-2.5 text-slate-600">{j.tanggal}</td>
                                                <td className="px-4 py-2.5 text-slate-600">{j.jam_mulai ? j.jam_mulai.substring(0, 5) : ''} WIB</td>
                                                <td className="px-4 py-2.5 font-semibold text-emerald-600">
                                                    Rp {Number(j.harga_tiket).toLocaleString('id-ID')}
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        ) : (
                            <p className="text-xs text-slate-500 italic bg-slate-50 p-4 rounded-lg border border-dashed border-slate-200">
                                Belum ada jadwal tayang aktif untuk film ini.
                            </p>
                        )}
                    </div>

                    <div className="pt-4 border-t border-slate-100 flex justify-between items-center text-sm">
                        <span className="text-xs text-slate-400">ID Film: #{film.id}</span>
                        <div className="flex items-center space-x-3">
                            <Link
                                href={`/film/${film.id}/edit`}
                                className="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg text-xs transition"
                            >
                                Ubah Film
                            </Link>

                            {/* Konfirmasi Hapus Menggunakan State (Pertemuan 6 Slide 13 & 30) */}
                            {konfirmasi ? (
                                <div className="flex items-center space-x-2 bg-rose-50 px-3 py-1.5 rounded-lg border border-rose-300">
                                    <span className="text-rose-700 text-xs font-bold">Hapus permanen?</span>
                                    <Link
                                        href={`/film/${film.id}`}
                                        method="delete"
                                        as="button"
                                        className="bg-rose-600 hover:bg-rose-700 text-white font-bold px-3 py-1 rounded text-xs transition"
                                    >
                                        Ya, Hapus
                                    </Link>
                                    <button
                                        type="button"
                                        onClick={() => setKonfirmasi(false)}
                                        className="text-slate-600 hover:text-slate-800 text-xs underline"
                                    >
                                        Batal
                                    </button>
                                </div>
                            ) : (
                                <button
                                    type="button"
                                    onClick={() => setKonfirmasi(true)}
                                    className="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 rounded-lg text-xs transition"
                                >
                                    Hapus Film
                                </button>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
