<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    //
    public function index(Request $request)
{
    $user = Auth::user();
    $roles = Role::all();   // Fetch all roles

    $search = $request->get('search');

    // Ambil data user yang memiliki role 'admin'
    $admins =User::when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('nik', 'like', "%{$search}%");
    })->paginate(10);

    return view('admin.pegawai.index', compact('admins','user','roles'));
}

}
