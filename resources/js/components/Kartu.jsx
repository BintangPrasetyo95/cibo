import React from 'react';

export default function Kartu({ judul, children, className = '' }) {
    return (
        <section className={`rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow ${className}`}>
            {judul && (
                <h2 className="font-bold text-xl text-slate-800 mb-4 border-b border-slate-100 pb-2">
                    {judul}
                </h2>
            )}
            {children}
        </section>
    );
}
