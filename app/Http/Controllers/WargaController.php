<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan ini mengimpor model User

class WargaController extends Controller
{
    public function index(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();
    $roles = Role::all();   // Fetch all roles

    // Check if the user is authenticated
    if (!$user) {
        // Handle the case when user is not authenticated
        return redirect()->route('login'); // or another appropriate action
    }

    // Ambil pencarian dari request
    $search = $request->get('search');

    // Ambil data pengguna dengan pencarian (jika ada)
    $wargas = User::when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('nik', 'like', "%{$search}%");
    })->paginate(10);

    // Kirim variabel $user dan $wargas ke view
    return view('admin.warga.index', compact('user', 'wargas' ,'roles'));
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'role' => 'required|exists:roles,name', // Make sure the role exists
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Sync the user's roles
    $user->syncRoles([$request->role]);

    // Redirect back with a success message
    return redirect()->route('warga.index')->with('success', 'Role updated successfully.');
}



    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID dan hapus
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('warga.index')->with('success', 'Warga berhasil dihapus.');
    }
}
