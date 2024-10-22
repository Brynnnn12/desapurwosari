<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login

        // Mengambil semua permission dengan pagination
        $permissions = Permission::paginate(10);
        $roles = Role::all(); // Mengambil semua role dari database

        // Mengembalikan view dengan data permissions, user, dan roles
        return view('admin.authorize.permissions.indexPermissions', compact('permissions', 'user', 'roles'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'permission' => 'required|min:3' // Validasi nama permission
        ]);

        // Membuat permission baru
        $permission = Permission::create([
            'name' => $request->permission, // Menggunakan 'permission' sebagai kunci untuk menyimpan nama permission
            'guard_name' => 'web' // Guard yang digunakan
        ]);

        // Memastikan $request->roles berisi array ID role yang valid sebelum menyinkronkan
        if ($request->has('roles')) {
            $permission->syncRoles($request->roles); // Menyinkronkan role dengan permission
        }

        // Redirect setelah sukses
        return redirect()->route('permissions.index')->with('success', 'Permission berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Mencari permission berdasarkan ID
        $permission = Permission::findOrFail($id);

        // Menghapus permission
        $permission->delete();

        // Redirect setelah sukses
        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dihapus!');
    }
}
