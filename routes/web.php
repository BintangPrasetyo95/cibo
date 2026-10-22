<?php

use App\Http\Controllers\FilmController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FilmController::class, 'index'])->name('home');

// 7 Aksi RESTful resource film (Pertemuan 2-7)
Route::resource('film', FilmController::class);

// Rute pembuktian autentikasi & pergantian peran (Pertemuan 7 Slide 5, 8, 30)
Route::get('/login-sebagai/{peran}', function (string $peran) {
    if (! in_array($peran, ['admin', 'kasir'], true)) {
        abort(404, 'Peran tidak valid.');
    }

    $user = User::firstOrCreate(
        ['email' => "{$peran}@cibo.test"],
        [
            'name' => ucfirst($peran) . ' CIBO',
            'password' => bcrypt('password'),
            'peran' => $peran,
        ]
    );

    // Update peran jika sudah ada
    $user->update(['peran' => $peran]);

    Auth::login($user);
    request()->session()->regenerate();

    return redirect()
        ->route('film.index')
        ->with('sukses', "Berhasil masuk sebagai {$user->name} [Peran: {$user->peran}].");
})->name('login.sebagai');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
        ->route('film.index')
        ->with('sukses', 'Anda telah berhasil keluar sistem.');
})->name('logout');
