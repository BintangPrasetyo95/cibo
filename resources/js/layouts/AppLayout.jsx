import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import PesanFlash from '@/components/PesanFlash';

export default function AppLayout({ children }) {
    // Membaca user yang sedang masuk via props bersama auth (Pertemuan 7 Slide 8)
    const { auth } = usePage().props;

    return (
        <div className="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans">
            {/* Navigasi Utama */}
            <header className="bg-slate-900 text-white shadow-md">
                <div className="max-w-6xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center gap-4">
                    <div className="flex items-center space-x-3">
                        <Link href="/film" className="text-2xl font-black tracking-wider text-emerald-400">
                            CIBO
                        </Link>
                        <span className="text-xs uppercase tracking-widest text-slate-400 font-semibold border-l border-slate-700 pl-3">
                            Cinema Booking
                        </span>
                    </div>

                    <div className="flex items-center space-x-4 md:space-x-6 text-sm font-medium">
                        <Link href="/film" className="hover:text-emerald-400 transition-colors">
                            Katalog Film
                        </Link>

                        {/* Status Autentikasi Pengguna (Pertemuan 7 Slide 5, 8) */}
                        {auth?.user ? (
                            <div className="flex items-center space-x-3 border-l border-slate-700 pl-4">
                                <span className="text-xs text-slate-300">
                                    Halo, <strong>{auth.user.name}</strong>
                                    <span className={`ml-2 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider ${
                                        auth.user.peran === 'admin'
                                            ? 'bg-rose-900 text-rose-200 border border-rose-700'
                                            : 'bg-emerald-900 text-emerald-200 border border-emerald-700'
                                    }`}>
                                        {auth.user.peran}
                                    </span>
                                </span>
                                <Link
                                    href="/logout"
                                    method="post"
                                    as="button"
                                    className="text-xs text-rose-400 hover:text-rose-300 underline font-medium"
                                >
                                    Keluar
                                </Link>
                            </div>
                        ) : (
                            <div className="flex items-center space-x-3 border-l border-slate-700 pl-4 text-xs">
                                <Link
                                    href="/login"
                                    className="text-slate-300 hover:text-white font-semibold transition"
                                >
                                    Masuk
                                </Link>
                                <Link
                                    href="/register"
                                    className="bg-emerald-500 hover:bg-emerald-600 text-slate-900 px-3 py-1.5 rounded-lg font-bold transition"
                                >
                                    Daftar Akun
                                </Link>
                            </div>
                        )}
                    </div>
                </div>
            </header>

            {/* Konten Halaman */}
            <main className="flex-grow max-w-6xl w-full mx-auto px-4 py-8">
                <PesanFlash />
                {children}
            </main>

            {/* Kaki Halaman */}
            <footer className="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
                <div className="max-w-6xl mx-auto px-4 space-y-1">
                    <p>Proyek Web Framework (INF625313) &bull; CIBO Cinema Booking System &bull; Kurikulum 2025</p>
                    <p className="text-[11px] text-slate-400">
                        Autentikasi & Otorisasi: Kata sandi teracak aman, pemutaran sesi, dan penegakan kewenangan multi-role di sisi server.
                    </p>
                </div>
            </footer>
        </div>
    );
}
