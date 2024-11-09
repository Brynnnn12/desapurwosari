<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{
    //


    public function index()
    {

        $user = Auth::user(); // Mengambil data user yang sedang login
        $roles = Role::with('permissions')->get(); // Ambil semua role dengan permissions terkait
         $permissions = Permission::all(); // Ambil semua permissions dari database

        return view('admin.authorize.roles.indexRoles', compact('roles', 'user', 'permissions'));
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

    public function edit($id)
{
    $role = Role::findOrFail($id); // Ambil role berdasarkan ID
    $permissions = Permission::all(); // Ambil semua permissions dari database

    return view('admin.authorize.roles.edit', compact('role', 'permissions')); // Kirim ke view
}
public function update(Request $request,Role  $role)
{

    $role->update([
        'name' => $request->name
    ]);
    $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

    $role->syncPermissions($permissions);
    return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
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
