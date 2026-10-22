import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/AppLayout';
import Kartu from '@/components/Kartu';

export default function Login({ judul }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    function kirim(e) {
        e.preventDefault();
        post('/login');
    }

    return (
        <AppLayout>
            <Head title={judul || 'Masuk ke Akun'} />

            <div className="max-w-md mx-auto my-6">
                <div className="text-center mb-6">
                    <h1 className="text-3xl font-black text-slate-900 tracking-wider">CIBO</h1>
                    <p className="text-sm text-slate-500 mt-1">Masuk ke sistem pemesanan tiket bioskop</p>
                </div>

                <Kartu judul={judul || 'Formulir Masuk'}>
                    <form onSubmit={kirim} className="space-y-4">
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
                                autoFocus
                            />
                            {errors.email && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.email}</p>
                            )}
                        </div>

                        {/* Password */}
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
                                placeholder="••••••••"
                            />
                            {errors.password && (
                                <p className="text-rose-600 text-xs mt-1 font-medium">{errors.password}</p>
                            )}
                        </div>

                        {/* Remember Me */}
                        <div className="flex items-center justify-between text-xs">
                            <label className="flex items-center space-x-2 text-slate-600 cursor-pointer">
                                <input
                                    type="checkbox"
                                    checked={data.remember}
                                    onChange={(e) => setData('remember', e.target.checked)}
                                    className="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                />
                                <span>Ingat saya di perangkat ini</span>
                            </label>
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
                                {processing ? 'Sedang Masuk…' : 'Masuk Sekarang'}
                            </button>
                        </div>

                        <div className="text-center pt-2 border-t border-slate-100 text-xs text-slate-600">
                            Belum memiliki akun?{' '}
                            <Link href="/register" className="text-emerald-600 hover:underline font-bold">
                                Daftar di sini
                            </Link>
                        </div>
                    </form>
                </Kartu>

                {/* Petunjuk Akun Bawaan */}
                <div className="mt-4 bg-slate-100 border border-slate-200 rounded-xl p-4 text-xs text-slate-600">
                    <p className="font-bold text-slate-700 mb-1">Akun Contoh Pengujian (Seeder):</p>
                    <ul className="list-disc list-inside space-y-0.5 text-slate-500">
                        <li><strong>Admin:</strong> admin@cibo.test &bull; Sandi: password</li>
                        <li><strong>Kasir:</strong> kasir@cibo.test &bull; Sandi: password</li>
                    </ul>
                </div>
            </div>
        </AppLayout>
    );
}
