import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';

export default function Index({ films, judul }) {
    return (
        <AppLayout>
            <Head title={judul || 'Katalog Film CIBO'} />

            <div className="flex justify-between items-center mb-6">
                <div>
                    <h1 className="text-3xl font-extrabold text-slate-900">{judul}</h1>
                    <p className="text-sm text-slate-500 mt-1">
                        Daftar film aktif yang disajikan melalui React 19 dan Inertia 3 tanpa API terpisah.
                    </p>
                </div>

                {/* Halaman create masih Blade pada pekan ini, gunakan tag <a> biasa sesuai Slide 32 */}
                <a
                    href="/film/create"
                    className="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition"
                >
                    + Tambah Film Baru (Blade)
                </a>
            </div>

            {/* Grid Katalog Film */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {films.data.map((f) => (
                    <div
                        key={f.id}
                        className="border border-slate-200 rounded-xl p-6 bg-white shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between"
                    >
                        <div>
                            <div className="flex flex-wrap items-center gap-2 mb-2">
                                <span className="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800">
                                    {f.genre}
                                </span>
                                <span className="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-800">
                                    {f.usia_rating}
                                </span>
                                <span className="text-xs text-slate-400">
                                    {f.durasi_menit} Menit
                                </span>
                            </div>

                            <h3 className="font-bold text-xl text-slate-800 mb-2">
                                {f.judul}
                            </h3>

                            <p className="text-slate-600 text-sm line-clamp-3">
                                {f.sinopsis}
                            </p>
                        </div>

                        <div className="pt-4 mt-4 border-t border-slate-100 space-y-2 text-xs">
                            <div className="flex justify-between items-center">
                                <span className="font-medium text-slate-500">
                                    Status: <strong className="text-emerald-600 uppercase">{f.status_tayang}</strong>
                                </span>
                                <span className="text-slate-400">
                                    {f.jadwals ? f.jadwals.length : 0} Jadwal Tayang
                                </span>
                            </div>

                            <div className="flex items-center justify-between pt-2 border-t border-slate-50">
                                <div className="space-x-3">
                                    {/* Navigasi sesama halaman React menggunakan komponen Link (Slide 20 & 32) */}
                                    <Link
                                        href={`/film/${f.id}`}
                                        className="text-blue-600 hover:underline font-semibold"
                                    >
                                        Rincian &rarr;
                                    </Link>

                                    {/* Halaman edit masih Blade pekan ini, gunakan tag <a> biasa (Slide 21 & 32) */}
                                    <a
                                        href={`/film/${f.id}/edit`}
                                        className="text-amber-600 hover:underline font-semibold"
                                    >
                                        Ubah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}

                {/* Keadaan Data Kosong (Pertemuan 5 Slide 17) */}
                {films.data.length === 0 && (
                    <div className="col-span-full bg-white border border-dashed border-slate-300 rounded-xl p-12 text-center text-slate-500">
                        <p className="text-lg font-medium text-slate-700 mb-1">
                            Belum ada data film di katalog.
                        </p>
                        <p className="text-sm mb-4">
                            Silakan tambahkan data film baru untuk memulai.
                        </p>
                        <a
                            href="/film/create"
                            className="text-emerald-600 font-semibold hover:underline"
                        >
                            + Tambah Film Sekarang
                        </a>
                    </div>
                )}
            </div>

            {/* Paginasi Inertia */}
            {films.links && films.links.length > 3 && (
                <div className="mt-8 flex justify-center space-x-1">
                    {films.links.map((link, idx) => (
                        <Link
                            key={idx}
                            href={link.url || '#'}
                            className={`px-3 py-2 text-xs font-medium rounded-md border ${
                                link.active
                                    ? 'bg-emerald-600 text-white border-emerald-600'
                                    : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'
                            } ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    ))}
                </div>
            )}
        </AppLayout>
    );
}
