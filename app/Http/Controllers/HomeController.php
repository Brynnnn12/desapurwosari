<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $beritas = Berita::orderBy('created_at', 'desc')->limit(6)->get();
        $jenisLayanans = JenisLayanan::all();
        return view('home.app', compact('jenisLayanans', 'beritas', 'user'));
    }
    // public function show($id)
    // {
    //     $berita = Berita::findOrFail($id);
    //     return view('home.partials.berita.show', compact('berita'));
    // }
    public function lihat()
    {
        $beritas = Berita::all();
        return view('home.partials.berita.show', compact('beritas'));
    }
}
