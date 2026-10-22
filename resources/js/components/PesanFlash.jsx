import React from 'react';
import { usePage } from '@inertiajs/react';

export default function PesanFlash() {
    const { flash } = usePage().props;

    if (!flash?.sukses && !flash?.galat) return null;

    return (
        <div className="mb-6 space-y-2">
            {flash?.sukses && (
                <div role="status" className="rounded-xl bg-emerald-50 border border-emerald-300 p-4 text-emerald-900 flex items-center justify-between shadow-sm">
                    <div className="flex items-center space-x-3">
                        <span className="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold">&check;</span>
                        <span className="font-medium text-sm">{flash.sukses}</span>
                    </div>
                </div>
            )}

            {flash?.galat && (
                <div role="alert" className="rounded-xl bg-rose-50 border border-rose-300 p-4 text-rose-900 flex items-center justify-between shadow-sm">
                    <div className="flex items-center space-x-3">
                        <span className="inline-flex items-center justify-center w-6 h-6 rounded-full bg-rose-600 text-white text-xs font-bold">&times;</span>
                        <span className="font-medium text-sm">{flash.galat}</span>
                    </div>
                </div>
            )}
        </div>
    );
}
