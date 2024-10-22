<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Menampilkan daftar pengaduan
    public function index(Request $request)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi

        $query = $request->get('search');
        $pengaduans = Pengaduan::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('isi_aduan', 'like', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('name', 'like', "%{$query}%");
                    });
            })
            ->paginate(10);

        return view('admin.pengaduans.index', compact('pengaduans', 'user'));
    }

    // Menampilkan form untuk membuat pengaduan baru
    public function create()
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        return view('admin.pengaduans.create', compact('user'));
    }

    // Menyimpan pengaduan baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'isi_aduan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $pengaduan = new Pengaduan();
        $pengaduan->user_id = Auth::id(); // Mengaitkan dengan pengguna yang terautentikasi
        $pengaduan->isi_aduan = $validatedData['isi_aduan']; // Menetapkan isi aduan

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
            $date = now()->format('Ymd_His'); // Format tanggal dan waktu

            // Membuat nama file baru
            $fileName = 'pengaduan_' . $user->name . '_' . $date . '.' . $request->file('gambar')->getClientOriginalExtension();

            // Pastikan folder tujuan ada
            $directory = 'pengaduan'; // Folder tujuan
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Simpan gambar
            $path = $request->file('gambar')->storeAs($directory, $fileName, 'public'); // Simpan gambar dengan nama baru
            $pengaduan->gambar = $path; // Simpan path gambar ke database
        }

        $pengaduan->save();

        return redirect()->route('pengaduans.index')->with('success', 'Aduan berhasil dibuat.');
    }

    // Menampilkan detail pengaduan
    public function show($id)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduans.show', compact('pengaduan', 'user'));
    }

    // Menampilkan form untuk mengedit pengaduan
    public function edit($id)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $pengaduan = Pengaduan::findOrFail($id);
        // Debugging
        if (!$pengaduan) {
            abort(404, 'Pengaduan tidak ditemukan.');
        }

        return view('admin.pengaduans.edit', compact('pengaduan', 'user'));
    }


    // Memperbarui pengaduan di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'isi_aduan' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Ambil pengaduan untuk update
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->isi_aduan = $validated['isi_aduan'];

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengaduan->gambar) {
                Storage::disk('public')->delete($pengaduan->gambar);
            }

            $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
            $date = now()->format('Ymd_His'); // Format tanggal dan waktu

            // Membuat nama file baru
            $fileName = 'pengaduan_' . $user->name . '_' . $date . '.' . $request->file('gambar')->getClientOriginalExtension();

            // Pastikan folder tujuan ada
            $directory = 'pengaduan'; // Folder tujuan
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Simpan gambar
            $path = $request->file('gambar')->storeAs($directory, $fileName, 'public'); // Simpan gambar dengan nama baru
            $pengaduan->gambar = $path; // Simpan path gambar ke database
        }

        $pengaduan->save();

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }



    // Menghapus pengaduan dari database
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);


        // Hapus gambar jika ada
        if ($pengaduan->gambar) {
            Storage::disk('public')->delete($pengaduan->gambar);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
