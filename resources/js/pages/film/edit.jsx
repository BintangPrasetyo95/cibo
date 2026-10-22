import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';
import Kartu from '@/components/Kartu';

export default function Edit({ film, judul }) {
    // Hook useForm dengan nilai awal dari props (Pertemuan 6 Slide 16)
    const { data, setData, put, processing, errors } = useForm({
        judul: film.judul || '',
        genre: film.genre || '',
        durasi_menit: film.durasi_menit || '',
        usia_rating: film.usia_rating || 'SU',
        sinopsis: film.sinopsis || '',
        status_tayang: film.status_tayang || 'segera',
    });

    function kirim(e) {
        e.preventDefault();
        put(`/film/${film.id}`);
    }

    return (
        <AppLayout>
            <Head title={judul || `Ubah Film: ${film.judul}`} />

            <div className="max-w-2xl mx-auto">
                <div className="mb-4">
                    <Link
                        href="/film"
                        className="text-xs text-slate-500 hover:text-emerald-600 font-semibold inline-flex items-center"
                    >
                        &larr; Kembali ke Katalog Film
                    </Link>
                </div>

                <Kartu judul={judul || `Ubah Film: ${film.judul}`}>
                    <form onSubmit={kirim} className="space-y-4">
                        {/* Judul Film */}
                        <div>
                            <label htmlFor="judul" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Judul Film <span className="text-rose-500">*</span>
                            </label>
                            <input
                                id="judul"
                                type="text"
                                value={data.judul}
                                onChange={(e) => setData('judul', e.target.value)}
                                className={`w-full border ${errors.judul ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                            />
                            {errors.judul && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.judul}</p>
                            )}
                        </div>

                        {/* Genre & Durasi */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label htmlFor="genre" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Genre <span className="text-rose-500">*</span>
                                </label>
                                <input
                                    id="genre"
                                    type="text"
                                    value={data.genre}
                                    onChange={(e) => setData('genre', e.target.value)}
                                    className={`w-full border ${errors.genre ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                />
                                {errors.genre && (
                                    <p className="text-rose-600 text-xs mt-1 font-medium">{errors.genre}</p>
                                )}
                            </div>

                            <div>
                                <label htmlFor="durasi_menit" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Durasi (Menit) <span className="text-rose-500">*</span>
                                </label>
                                <input
                                    id="durasi_menit"
                                    type="number"
                                    value={data.durasi_menit}
                                    onChange={(e) => setData('durasi_menit', e.target.value)}
                                    className={`w-full border ${errors.durasi_menit ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                />
                                {errors.durasi_menit && (
                                    <p className="text-rose-600 text-xs mt-1 font-medium">{errors.durasi_menit}</p>
                                )}
                            </div>
                        </div>

                        {/* Rating Usia & Status Tayang */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label htmlFor="usia_rating" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Rating Usia <span className="text-rose-500">*</span>
                                </label>
                                <select
                                    id="usia_rating"
                                    value={data.usia_rating}
                                    onChange={(e) => setData('usia_rating', e.target.value)}
                                    className={`w-full border ${errors.usia_rating ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                >
                                    <option value="SU">Semua Umur (SU)</option>
                                    <option value="13+">Remaja (13+)</option>
                                    <option value="17+">Dewasa (17+)</option>
                                    <option value="21+">Dewasa Khusus (21+)</option>
                                </select>
                                {errors.usia_rating && (
                                    <p className="text-rose-600 text-xs mt-1 font-medium">{errors.usia_rating}</p>
                                )}
                            </div>

                            <div>
                                <label htmlFor="status_tayang" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Status Penayangan <span className="text-rose-500">*</span>
                                </label>
                                <select
                                    id="status_tayang"
                                    value={data.status_tayang}
                                    onChange={(e) => setData('status_tayang', e.target.value)}
                                    className={`w-full border ${errors.status_tayang ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                >
                                    <option value="segera">Segera Tayang</option>
                                    <option value="tayang">Sedang Tayang</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                {errors.status_tayang && (
                                    <p className="text-rose-600 text-xs mt-1 font-medium">{errors.status_tayang}</p>
                                )}
                            </div>
                        </div>

                        {/* Sinopsis */}
                        <div>
                            <label htmlFor="sinopsis" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Sinopsis Film <span className="text-rose-500">*</span>
                            </label>
                            <textarea
                                id="sinopsis"
                                rows="4"
                                value={data.sinopsis}
                                onChange={(e) => setData('sinopsis', e.target.value)}
                                className={`w-full border ${errors.sinopsis ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                            />
                            {errors.sinopsis && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.sinopsis}</p>
                            )}
                        </div>

                        {/* Tombol Simpan dengan Status Processing */}
                        <div className="pt-4 border-t border-slate-100 flex justify-end space-x-3">
                            <Link
                                href="/film"
                                className="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-50 transition"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                disabled={processing}
                                className={`px-5 py-2 rounded-lg text-sm font-semibold text-white shadow-sm transition ${
                                    processing
                                        ? 'bg-slate-400 cursor-not-allowed'
                                        : 'bg-emerald-600 hover:bg-emerald-700'
                                }`}
                            >
                                {processing ? 'Menyimpan…' : 'Simpan Perubahan'}
                            </button>
                        </div>
                    </form>
                </Kartu>
            </div>
        </AppLayout>
    );
}
