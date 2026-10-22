<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'CIBO - Cinema Booking System' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans">
    <!-- Navigasi Utama -->
    <header class="bg-slate-900 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-2xl font-black tracking-wider text-emerald-400">CIBO</span>
                <span class="text-xs uppercase tracking-widest text-slate-400 font-semibold border-l border-slate-700 pl-3">Cinema Booking</span>
            </div>
            <nav class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('film.index') }}" class="hover:text-emerald-400 transition-colors">Katalog Film</a>
                <a href="{{ route('film.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-semibold px-4 py-2 rounded-lg transition-colors">
                    + Tambah Film
                </a>
            </nav>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 py-8">
        @yield('isi')
    </main>

    <!-- Kaki Halaman -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4">
            <p>Proyek Web Framework (INF625313) &bull; CIBO Cinema Booking System &bull; Kurikulum 2025</p>
        </div>
    </footer>
</body>
</html>
