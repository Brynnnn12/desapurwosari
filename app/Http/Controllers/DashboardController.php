<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::user();
        // dd($user->getRoleNames());

        // Mendapatkan pengguna yang sedang masuk
        // Mengambil pesan sukses dari session
        $successMessage = session('success');

        $totalUser = User::count();
        $totalJenisLayanan = JenisLayanan::count();
        $totalPengaduan = Pengaduan::count();


        // Mengembalikan tampilan dashboard dengan pesan sukses
        return view('admin.dashboard', compact('successMessage','totalUser', 'totalJenisLayanan', 'totalPengaduan', 'user'));
    }
}
