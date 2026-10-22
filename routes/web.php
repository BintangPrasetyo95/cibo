<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FilmController::class, 'index'])->name('home');

// 7 Aksi RESTful resource film (Pertemuan 2-7)
Route::resource('film', FilmController::class);

// Rute Autentikasi Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'prosesLogin']);
    Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister']);
});

// Rute Logout Pengguna
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Pembantu Pengujian Peran (Pertemuan 7 Slide 30)
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

    $user->update(['peran' => $peran]);

    Auth::login($user);
    request()->session()->regenerate();

    return redirect()
        ->route('film.index')
        ->with('sukses', "Berhasil masuk sebagai {$user->name} [Peran: {$user->peran}].");
})->name('login.sebagai');
