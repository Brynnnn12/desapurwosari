<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
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

        if (!$user) {
            abort(403, 'User not authenticated'); // Menghentikan eksekusi jika user tidak terautentikasi
        }

        if (!$user instanceof User) {
            abort(500, 'User is not an instance of User'); // Menghentikan eksekusi jika bukan instance User
        }
        // Hitung umur pengguna
        $umur = $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->age : null;

        // Ambil bulan sekarang
        $bulanSekarang = Carbon::now()->locale('id')->translatedFormat('F'); // Nama bulan dalam bahasa Indonesia

        $query = $request->get('search');
        $pengaduans = Pengaduan::with('user')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('isi_aduan', 'like', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('name', 'like', "%{$query}%");
                    });
            });

        // Cek apakah pengguna adalah admin
        if ($user->hasRole('admin')) {
            // Jika admin, ambil semua pengaduan
            $pengaduans = $pengaduans->paginate(10); // Paginasi 10 item per halaman
        } else {
            // Jika bukan admin, ambil pengaduan hanya yang diajukan oleh user yang sedang login
            $pengaduans = $pengaduans->where('user_id', $user->id)->paginate(10); // Paginasi 10 item per halaman
        }

        return view('admin.pengaduans.index', compact('pengaduans', 'user', 'umur', 'bulanSekarang'));
    }


    // Menampilkan form untuk membuat pengaduan baru
    // public function create()
    // {
    //     $user = Auth::user(); // Dapatkan pengguna yang terautentikasi

    //     if (
    //         empty($user->nik) || empty($user->tempat_lahir) || empty($user->tanggal_lahir) || empty($user->alamat) ||
    //         empty($user->jenis_kelamin)  || empty($user->pendidikan) || empty($user->pekerjaan)
    //     ) {

    //         // Redirect dengan pesan peringatan jika profil belum lengkap
    //         return redirect()->route('profile.edit')->with('warning', 'Silakan lengkapi profil Anda sebelum mengajukan surat pengantar.');
    //     }
    //     // Hitung umur
    //     $umur = null;
    //     if ($user->tanggal_lahir) {
    //         $umur = Carbon::parse($user->tanggal_lahir)->age; // Menghitung umur
    //     }

    //     // Ambil bulan sekarang
    //     $bulanSekarang = Carbon::now()->locale('id')->translatedFormat('F'); // Nama bulan dalam bahasa Indonesia

    //     return view('admin.pengaduans.create', compact('user'));
    // }

    // Menyimpan pengaduan baru ke database
    public function store(Request $request)
    {
        try {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi


        if (
            empty($user->nik) || empty($user->tempat_lahir) || empty($user->tanggal_lahir) || empty($user->alamat) ||
            empty($user->jenis_kelamin)  || empty($user->pendidikan) || empty($user->pekerjaan)
        ) {

            // Redirect dengan pesan peringatan jika profil belum lengkap
            return redirect()->route('profile.edit')->with('error', 'Silakan lengkapi profil Anda sebelum memberi Kritik & Saran.');
        }
        // Validasi input
        $validatedData = $request->validate([
            'isi_aduan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'gambar.max' => 'Ukuran gambar maksimal 2MB', // Pesan kustom untuk validasi ukuran
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
    } catch (Exception $e) {
        // Tangani kesalahan jika terjadi
        return redirect()->route('pengaduans.index')->with('error', 'Terjadi kesalahan saat menyimpan pengaduans: ' . $e->getMessage());
    }
}

    // Menampilkan detail pengaduan
    // public function show($id)
    // {
    //     $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
    //     $pengaduan = Pengaduan::findOrFail($id);
    //     return view('admin.pengaduans.show', compact('pengaduan', 'user'));
    // }

    // Menampilkan form untuk mengedit pengaduan
    // public function edit($id)
    // {
    //     $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
    //     $pengaduan = Pengaduan::findOrFail($id);
    //     // Debugging
    //     if (!$pengaduan) {
    //         abort(404, 'Pengaduan tidak ditemukan.');
    //     }

    //     return view('admin.pengaduans.edit', compact('pengaduan', 'user'));
    // }


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
        if (!$pengaduan) {
            abort(404, 'Pengaduan tidak ditemukan.'); // Menghentikan eksekusi jika pengaduan tidak ditemukan
        }

        // Hapus gambar jika ada
        if ($pengaduan->gambar) {
            Storage::disk('public')->delete($pengaduan->gambar);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
