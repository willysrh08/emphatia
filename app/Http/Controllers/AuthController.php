<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Memproses autentikasi pengguna (login).
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email' => 'alamat email',
            'password' => 'kata sandi',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email atau kata sandi yang Anda masukkan salah.',
                ])
                ->onlyInput('email');
        }

        // Regenerasi session ID setelah login berhasil
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Menampilkan halaman register (pendaftaran).
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Memproses pendaftaran pengguna baru, lalu otomatis login.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], [
            'name' => 'nama',
            'email' => 'alamat email',
            'password' => 'kata sandi',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Otomatis login pengguna setelah pendaftaran berhasil
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /**
     * Mengeluarkan pengguna dari sesi (logout).
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate session aktif dan hapus token CSRF lama
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
