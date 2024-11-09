<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        } else {
            return redirect()->route('auth.login')->with('error', 'Login Gagal!');
        }

    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');


        return redirect('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        // Debug sebelum logout untuk memastikan pengguna sedang login
        // dd(Auth::check()); // Ini akan mengembalikan true jika pengguna sedang login, dan false jika tidak.

        Auth::logout();

        // Debug setelah logout untuk memastikan pengguna telah berhasil logout
        // dd(Auth::check()); // Ini akan mengembalikan false setelah logout jika berhasil.

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_proses(Request $request)
{
    $customMessage = [
        'email.required' => 'Email Tidak Boleh Kosong',
        'email.email' => 'Email Tidak Valid',
        'email.exists' => 'Email Tidak terdaftar',
    ];

    $request->validate([
        'email' => 'required|email|exists:users,email'
    ], $customMessage);

    // Mengambil user berdasarkan email
    $user = User::where('email', $request->email)->first();
    $token = Str::random(60);


    PasswordReset::updateOrCreate(
        ['email' => $request->email],
        [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]
    );

    // Kirim email dengan user dan token
    Mail::to($request->email)->send(new ResetPassword($user, $token));

    return redirect()->route('auth.forgot-password')->with('success', 'Anda telah berhasil meminta reset password. Silakan cek email Anda.');
}

// Fungsi untuk menampilkan halaman reset password
public function reset_password(Request $request, $token)
{
    // Cari token di tabel PasswordReset berdasarkan nilai token
    $getToken = PasswordReset::where('token', $token)->first();

    // Jika token tidak ditemukan, redirect ke halaman login dengan pesan error
    if (!$getToken) {
        return redirect()->route('auth.login')->with('error', 'Token Tidak Valid');
    }

    // Jika token valid, arahkan ke halaman reset-password dan kirim token
    return view('auth.reset-password', compact('token'));
}

// Fungsi untuk memproses reset password
// Fungsi untuk memproses reset password
public function reset_password_proses(Request $request)
{
    // Pesan kustom untuk validasi
    $customMessage = [
        'password.required' => 'Password tidak boleh kosong',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak sesuai',
    ];

    // Validasi input untuk password
    $request->validate([
        'password' => 'required|confirmed|min:8',
        'token' => 'required' // pastikan token juga divalidasi
    ], $customMessage);

    // Debug untuk melihat semua input request
    // dd($request->all());

    // Cari password reset token di database
    $passwordReset = PasswordReset::where('token', $request->token)->first();
    // Cek apakah token valid
    if (!$passwordReset) {
        return redirect()->route('auth.forgot-password')->with('error', 'Token tidak valid.');
    }
    // dd($passwordReset);
    // Cari pengguna berdasarkan email dari token
    $user = User::where('email', $passwordReset->email)->first();

    // Cek apakah pengguna ditemukan
    if (!$user) {
        return redirect()->route('auth.forgot-password')->with('error', 'Pengguna tidak ditemukan.');
    }

    // dd($user);
    // Update password pengguna
    $user->update([
        'password' => Hash::make($request->password)
    ]);

    // Hapus record token setelah berhasil mereset password
    $passwordReset->delete();

    // Arahkan pengguna ke halaman login dengan pesan sukses
    return redirect()->route('auth.login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
}

}
