<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Menampilkan formulir masuk (Login).
     */
    public function tampilLogin()
    {
        if (Auth::check()) {
            return redirect()->route('film.index');
        }

        return Inertia::render('auth/login', [
            'judul' => 'Masuk ke CIBO',
        ]);
    }

    /**
     * Memproses autentikasi masuk dengan pemutaran ulang sesi (Pertemuan 7 Slide 7).
     */
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi yang Anda masukkan salah.',
            ]);
        }

        // Putar ulang sesi untuk menangkal serangan Session Fixation (Pertemuan 7 Slide 7)
        $request->session()->regenerate();

        return redirect()->intended(route('film.index'))
            ->with('sukses', 'Selamat datang kembali, ' . Auth::user()->name . '!');
    }

    /**
     * Menampilkan formulir pendaftaran pengguna baru.
     */
    public function tampilRegister()
    {
        if (Auth::check()) {
            return redirect()->route('film.index');
        }

        return Inertia::render('auth/register', [
            'judul' => 'Daftar Akun CIBO',
        ]);
    }

    /**
     * Memproses registrasi akun baru dengan kata sandi teracak aman (Pertemuan 7 Slide 6).
     */
    public function prosesRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'peran' => ['nullable', 'string', 'in:admin,kasir'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar dalam sistem.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'peran' => $validated['peran'] ?? 'kasir',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('film.index')
            ->with('sukses', 'Pendaftaran berhasil! Selamat datang di CIBO, ' . $user->name . '.');
    }

    /**
     * Menghapus sesi masuk pengguna (Pertemuan 7 Slide 5 & 7).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('film.index')
            ->with('sukses', 'Anda telah berhasil keluar dari sistem.');
    }
}
