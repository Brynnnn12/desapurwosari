<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan Anda mengimpor model User

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }
    public function edit()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'nik' => 'required|string|max:16',
            'pekerjaan' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'pendidikan' => 'required|in:SD,SMP,SMK,DIPLOMA,SARJANA',
            'alamat' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed', // Validasi password jika diisi
        ]);

        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'Silakan login untuk mengedit profil.');
        }
        if (!($user instanceof User)) {
            return redirect()->route('profile.show')->with('error', 'Pengguna tidak valid.');
        }



        // Mengupdate atribut pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->pekerjaan = $request->pekerjaan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->pendidikan = $request->pendidikan;
        $user->alamat = $request->alamat;
        $user->phone = $request->phone;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;



        // Cek jika ada avatar yang diupload
    // Cek apakah ada file avatar yang diupload
    // Mengganti avatar jika ada
    if ($request->hasFile('avatar')) {
        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Menghilangkan karakter yang tidak valid dari nama pengguna
        $cleanedName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name);

        // Menggunakan storeAs untuk mengubah nama file
        $avatarName = 'Profil_' . $cleanedName . '_' . $user->id . '.' . $request->file('avatar')->getClientOriginalExtension();
        $avatarPath = $request->file('avatar')->storeAs('avatars', $avatarName, 'public');
        $user->avatar = $avatarPath; // Menyimpan path file avatar baru
    }

    // Cek apakah pengguna ingin menghapus avatar
    if ($request->input('delete_avatar') == 1) {
        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null; // Atur ulang ke null jika dihapus
        }
    }




        // Cek jika password diisi, maka hash dan simpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the new password
        }

        // Simpan perubahan
        $user->save(); // Pastikan $user adalah instance dari User model

        return redirect()->route('profile.show')->with('success', 'Profil Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        // Optional: Check if the user has permission to delete
        // if (Auth::user()->id !== $user->id) {
        //     return redirect()->route('auth.login')->with('error', 'Anda tidak memiliki izin untuk menghapus akun ini.');
        // }
        $user = User::findOrFail($id); // Menemukan pengguna berdasarkan ID

        // Hapus gambar avatar dari penyimpanan jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }



        // Delete the user
        $user->delete();

        // Log out the user if it's their own account
        Auth::logout();

        return redirect()->route('auth.login')->with('success', 'Akun Anda telah berhasil dihapus.');
    }
}
