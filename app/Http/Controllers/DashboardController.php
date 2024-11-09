<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use App\Models\JenisLayanan;
use App\Models\SuratPengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {

        $user = Auth::user();
        if (!$user) {
            return 'User not authenticated'; // User tidak terautentikasi
        }

        if (!$user instanceof User) {
            return 'User is not an instance of User'; // Memastikan tipe objek
        }

        // dd($user->getRoleNames());

        // Mendapatkan pengguna yang sedang masuk
        // Mengambil pesan sukses dari session

        // Hitung total pengguna yang bukan admin
        $totalUser = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin'); // Ganti 'admin' dengan nama role admin Anda jika berbeda
        })->count();
        $totalPengaduan = 0; // Inisialisasi untuk total pengaduan
        $totalSurat = 0; // Inisialisasi untuk total surat
        $successMessage = session('success');

        // Jika pengguna adalah admin, ambil semua data
        if ($user->hasRole('admin')) {
            $totalJenisLayanan = JenisLayanan::count();
            $totalPengaduan = Pengaduan::count();
            $totalSurat = SuratPengantar::count();
        } else {
            // Jika bukan admin, hanya ambil data mereka sendiri
            $totalPengaduan = Pengaduan::where('user_id', $user->id)->count();
            $totalSurat = SuratPengantar::where('user_id', $user->id)->count();
        }


        // Mengembalikan tampilan dashboard dengan pesan sukses
        return view('admin.dashboard', compact('successMessage', 'totalUser', 'totalSurat', 'totalPengaduan', 'user'));
    }
}
