<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Mengambil data user yang sedang login

        // Mengambil semua permission dengan pagination
        $permissions = Permission::paginate(10);
        $roles = Role::all(); // Mengambil semua role dari database

        $edit = false ;
        if($request->edit){
            $edit= Permission::find($request->edit);

        }

        // Mengembalikan view dengan data permissions, user, dan roles
        return view('admin.authorize.permissions.indexPermissions', compact('permissions', 'user', 'roles', 'edit'));
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

//     public function edit($id)
// {
//     // Mencari permission berdasarkan ID
//     $permission = Permission::findOrFail($id);
//     $roles = Role::all(); // Mengambil semua role dari database

//     // Mengembalikan view dengan data permission dan roles
//     return view('admin.authorize.permissions.edit', compact('permission', 'roles'));
// }

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'permission' => 'required|min:3' // Validasi nama permission
    ]);

    // Mencari permission berdasarkan ID
    $permission = Permission::findOrFail($id);

    // Check if the new permission name already exists
    if ($permission->name !== $request->permission) {
        $existingPermission = Permission::where('name', $request->permission)
            ->where('guard_name', $permission->guard_name) // Ensure the same guard name
            ->first();

        if ($existingPermission) {
            return redirect()->route('permissions.index')->with('error', 'Permission with this name already exists!');
        }

        // Memperbarui nama permission
        $permission->name = $request->permission;
    }

    // Save the updated permission
    $permission->save();

    // Sync roles only if they exist
    if ($request->has('roles')) {
        $validRoles = Role::whereIn('id', $request->roles)->pluck('id')->toArray();

        if (!empty($validRoles)) {
            $permission->syncRoles($validRoles);
        } else {
            return redirect()->route('permissions.index')->with('error', 'One or more roles do not exist.');
        }
    }

    // Redirect setelah sukses
    return redirect()->route('permissions.index')->with('success', 'Permission berhasil diperbarui!');
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
