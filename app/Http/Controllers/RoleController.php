<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    //
    public function index()
    {

        $user = Auth::user(); // Mengambil data user yang sedang login
        $roles = Role::all();
        return view('admin.authorize.roles.indexRoles', compact('roles', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|min:3' // Ganti 'roles' dengan 'name'
        ]);

        // Membuat role baru
        Role::create([
            'name' => $request->name, // Ganti 'roles' dengan 'name'
            'guard_name' => 'web'
        ]);

        // Redirect setelah sukses
        return redirect()->route('roles.index')->with('success', 'Role berhasil disimpan!');
    }
    public function destroy($id)
    {
        // Mencari role berdasarkan ID
        $role = Role::findOrFail($id);

        // Menghapus role
        $role->delete();

        // Redirect setelah sukses
        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus!');
    }
}
