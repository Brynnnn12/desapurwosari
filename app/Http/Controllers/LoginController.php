<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan kamu mengimpor model User
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email', // Email harus diisi dan valid
            'password' => 'required|min:6', // Password harus diisi dan minimal 6 karakter
        ]);

        // Data yang digunakan untuk autentikasi
        $credentials = $request->only('email', 'password');

        // Cek apakah autentikasi berhasil
        if (Auth::attempt($credentials)) {
            // Jika berhasil, redirect ke dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        } else {
            // Jika gagal, redirect kembali ke halaman login dengan pesan error
            return redirect()->route('auth.login')->with('error', 'Login Gagal!');

        }
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth.register');
    }

    // Memproses registrasi
    public function register_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users', // Email harus unik
            'password' => 'required|string|min:6|confirmed', // Password harus diisi, minimal 6 karakter, dan sama dengan konfirmasi
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
        ]);

        // Redirect setelah registrasi berhasil
        return redirect('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout(); // Melakukan logout
        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }
}
