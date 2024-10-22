<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Mengimpor Auth dengan benar

use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    // * Tampilkan daftar jenis layanan.
    //  */
    public function index(Request $request)
    {

        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi

        // Ambil kata kunci pencarian dari input form
        $search = $request->input('search');

        // Query untuk mendapatkan data jenis layanan, dengan fitur pencarian
        $jenisLayanans = JenisLayanan::when($search, function ($query, $search) {
            return $query->where('nama_layanan', 'like', "%{$search}%");
        })
            ->paginate(10);

        // Kirim data ke view, termasuk hasil pencarian dan user
        return view('admin.jenis_layanans.index', compact('jenisLayanans', 'user'));
    }


    /**
     * Tampilkan form untuk membuat jenis layanan baru.
     */
    public function create()
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi

        return view('admin.jenis_layanans.create', compact('user')); // Sintaks yang benar
    }

    /**
     * Simpan jenis layanan baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string',
        ]);

        JenisLayanan::create([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect('/jenis_layanans')->with('success', 'Jenis Layanan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit jenis layanan.
     */
    public function edit($id)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $jenisLayanan = JenisLayanan::findOrFail($id);
        return view('admin.jenis_layanans.edit', compact('jenisLayanan', 'user'));
    }

    /**
     * Update jenis layanan dalam database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        $jenisLayanan = JenisLayanan::findOrFail($id);
        $jenisLayanan->update([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect('/jenis_layanans')->with('success', 'Jenis Layanan berhasil diperbarui.');
    }

    /**
     * Hapus jenis layanan dari database.
     */
    public function destroy($id)
    {
        $jenisLayanan = JenisLayanan::findOrFail($id);
        $jenisLayanan->delete();

        return redirect('/jenis_layanans')->with('success', 'Jenis Layanan berhasil dihapus.');
    }
}
