import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';
import BarisFilm from '@/components/BarisFilm';
import Kosong from '@/components/Kosong';

export default function Index({ films, judul, can }) {
    return (
        <AppLayout>
            <Head title={judul || 'Katalog Film CIBO'} />

            <div className="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div>
                    <h1 className="text-3xl font-extrabold text-slate-900">{judul}</h1>
                    <p className="text-sm text-slate-500 mt-1">
                        Daftar katalog film bioskop aktif &bull; Otorisasi dikontrol server melalui Policy.
                    </p>
                </div>

                {/* Tombol Tambah Hanya Ditampilkan Bila can.tambah bernilai true (Pertemuan 7 Slide 21 & 22) */}
                {can?.tambah ? (
                    <Link
                        href="/film/create"
                        className="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition"
                    >
                        + Tambah Film Baru
                    </Link>
                ) : (
                    <div className="text-xs text-slate-400 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-lg">
                        Mode kasir: Hanya dapat melihat katalog
                    </div>
                )}
            </div>

            {/* Grid Katalog Film */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {films.data.map((f) => (
                    <BarisFilm key={f.id} film={f} canTambah={can?.tambah} />
                ))}

                {/* Keadaan Data Kosong */}
                {films.data.length === 0 && (
                    <Kosong
                        pesan="Belum ada data film terdaftar di sistem CIBO."
                        aksi={
                            can?.tambah ? (
                                <Link
                                    href="/film/create"
                                    className="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-sm transition"
                                >
                                    + Tambah Film Sekarang
                                </Link>
                            ) : null
                        }
                    />
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
