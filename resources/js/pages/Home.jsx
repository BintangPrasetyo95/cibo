import React from 'react';

export default function Home({ pesan }) {
    return (
        <div className="bg-slate-900 text-emerald-400 p-20 text-center min-h-screen">
            <h1 className="text-4xl font-bold">CIBO - Cinema Booking System</h1>
            <p className="text-white mt-4 text-xl">{pesan}</p>
            <p className="text-gray-400 mt-2">Laravel + React + Tailwind + PostgreSQL</p>
        </div>
    );
}
