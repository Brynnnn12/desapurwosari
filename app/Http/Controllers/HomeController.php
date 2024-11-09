<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $jenisLayanans = JenisLayanan::all(); // Pastikan ini sesuai dengan model Anda
        return view('home.app', compact('jenisLayanans'));
    }
}
