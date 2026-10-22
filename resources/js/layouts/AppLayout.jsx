import React from 'react';
import { Link } from '@inertiajs/react';
import PesanFlash from '@/components/PesanFlash';

export default function AppLayout({ children, judul }) {
    return (
        <div className="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans">
            {/* Navigasi Utama */}
            <header className="bg-slate-900 text-white shadow-md">
                <div className="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
                    <div className="flex items-center space-x-3">
                        <Link href="/film" className="text-2xl font-black tracking-wider text-emerald-400">
                            CIBO
                        </Link>
                        <span className="text-xs uppercase tracking-widest text-slate-400 font-semibold border-l border-slate-700 pl-3">
                            Cinema Booking
                        </span>
                    </div>
                    <nav className="flex items-center space-x-6 text-sm font-medium">
                        <Link href="/film" className="hover:text-emerald-400 transition-colors">
                            Katalog Film
                        </Link>
                        {/* Sekarang seluruh halaman sudah React (Pertemuan 6 Slide 30) */}
                        <Link
                            href="/film/create"
                            className="bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-semibold px-4 py-2 rounded-lg transition-colors"
                        >
                            + Tambah Film
                        </Link>
                    </nav>
                </div>
            </header>

            {/* Konten Halaman */}
            <main className="flex-grow max-w-6xl w-full mx-auto px-4 py-8">
                {/* Pesan Flash Dibagikan untuk Semua Halaman (Pertemuan 6 Slide 25 & 26) */}
                <PesanFlash />
                {children}
            </main>

            {/* Kaki Halaman */}
            <footer className="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
                <div className="max-w-6xl mx-auto px-4">
                    <p>Proyek Web Framework (INF625313) &bull; CIBO Cinema Booking System &bull; Kurikulum 2025</p>
                </div>
            </footer>
        </div>
    );
}
