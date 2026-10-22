import React from 'react';

export default function Kosong({ pesan, aksi }) {
    return (
        <div className="col-span-full p-12 text-center bg-white border border-dashed border-slate-300 rounded-xl">
            <p className="text-slate-600 mb-4 text-base font-medium">{pesan}</p>
            {aksi}
        </div>
    );
}
