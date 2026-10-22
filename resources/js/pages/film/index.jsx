import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';
import BarisFilm from '@/components/BarisFilm';
import Kosong from '@/components/Kosong';

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

                <Link
                    href="/film/create"
                    className="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition"
                >
                    + Tambah Film Baru
                </Link>
            </div>

            {/* Grid Katalog Film Menggunakan Komponen BarisFilm (Pertemuan 6 Slide 7 & 8) */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {films.data.map((f) => (
                    <BarisFilm key={f.id} film={f} />
                ))}

                {/* Keadaan Data Kosong Menggunakan Komponen Kosong (Pertemuan 6 Slide 23 & 26) */}
                {films.data.length === 0 && (
                    <Kosong
                        pesan="Belum ada data film terdaftar di sistem CIBO."
                        aksi={
                            <Link
                                href="/film/create"
                                className="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-sm transition"
                            >
                                + Tambah Film Sekarang
                            </Link>
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
