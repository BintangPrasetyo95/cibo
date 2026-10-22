import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';
import Kartu from '@/components/Kartu';

export default function Register({ judul }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        peran: 'kasir',
    });

    function kirim(e) {
        e.preventDefault();
        post('/register');
    }

    return (
        <AppLayout>
            <Head title={judul || 'Pendaftaran Akun Baru'} />

            <div className="max-w-md mx-auto my-6">
                <div className="text-center mb-6">
                    <h1 className="text-3xl font-black text-slate-900 tracking-wider">CIBO</h1>
                    <p className="text-sm text-slate-500 mt-1">Daftar akun baru untuk mengakses sistem bioskop</p>
                </div>

                <Kartu judul={judul || 'Formulir Pendaftaran'}>
                    <form onSubmit={kirim} className="space-y-4">
                        {/* Nama Lengkap */}
                        <div>
                            <label htmlFor="name" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Nama Lengkap <span className="text-rose-500">*</span>
                            </label>
                            <input
                                id="name"
                                type="text"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                className={`w-full border ${errors.name ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                placeholder="Contoh: Budi Santoso"
                                autoFocus
                            />
                            {errors.name && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.name}</p>
                            )}
                        </div>

                        {/* Email */}
                        <div>
                            <label htmlFor="email" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Alamat Email <span className="text-rose-500">*</span>
                            </label>
                            <input
                                id="email"
                                type="email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                className={`w-full border ${errors.email ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                placeholder="nama@domain.com"
                            />
                            {errors.email && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.email}</p>
                            )}
                        </div>

                        {/* Peran Pengguna */}
                        <div>
                            <label htmlFor="peran" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Peran / Role Akun <span className="text-rose-500">*</span>
                            </label>
                            <select
                                id="peran"
                                value={data.peran}
                                onChange={(e) => setData('peran', e.target.value)}
                                className={`w-full border ${errors.peran ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                            >
                                <option value="kasir">Kasir / Petugas Loket (Pemesanan Tiket)</option>
                                <option value="admin">Administrator (Kelola Film & Laporan)</option>
                            </select>
                            {errors.peran && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.peran}</p>
                            )}
                        </div>

                        {/* Kata Sandi */}
                        <div>
                            <label htmlFor="password" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Kata Sandi <span className="text-rose-500">*</span>
                            </label>
                            <input
                                id="password"
                                type="password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                className={`w-full border ${errors.password ? 'border-rose-500 bg-rose-50' : 'border-slate-300'} rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500`}
                                placeholder="Minimal 8 karakter"
                            />
                            {errors.password && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.password}</p>
                            )}
                        </div>

                        {/* Konfirmasi Kata Sandi */}
                        <div>
                            <label htmlFor="password_confirmation" className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Ulangi Kata Sandi <span className="text-rose-500">*</span>
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                value={data.password_confirmation}
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                                className="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                placeholder="Ketik ulang kata sandi"
                            />
                        </div>

                        {/* Submit Button */}
                        <div className="pt-2">
                            <button
                                type="submit"
                                disabled={processing}
                                className={`w-full py-2.5 rounded-lg text-sm font-bold text-white shadow-sm transition ${
                                    processing
                                        ? 'bg-slate-400 cursor-not-allowed'
                                        : 'bg-emerald-600 hover:bg-emerald-700'
                                }`}
                            >
                                {processing ? 'Mendaftar…' : 'Daftar Sekarang'}
                            </button>
                        </div>

                        <div className="text-center pt-2 border-t border-slate-100 text-xs text-slate-600">
                            Sudah memiliki akun?{' '}
                            <Link href="/login" className="text-emerald-600 hover:underline font-bold">
                                Masuk di sini
                            </Link>
                        </div>
                    </form>
                </Kartu>
            </div>
        </AppLayout>
    );
}
