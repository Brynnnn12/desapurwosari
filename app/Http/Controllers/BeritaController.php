<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Ambil daftar berita dengan pencarian jika ada
        $beritas = Berita::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Change this to paginate

        return view('admin.berita.index', compact('beritas', 'search', 'user'));
    }

    // Menampilkan form untuk membuat berita baru
    public function create()
    {
        return view('admin.berita.create');
    }

    // Menyimpan berita baru ke database
    public function store(Request $request)
    {
        // Periksa apakah pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal_terbit' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240', // max 10MB
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_berita', 'public');
        }

        // Upload video jika ada
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('video_berita', 'public');
        }

        // Simpan berita ke database
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_terbit' => $request->tanggal_terbit,
            'foto' => $fotoPath,
            'video' => $videoPath,
            'slug' => Str::slug($request->judul), // Menambahkan slug
            'user_id' => Auth::id(), // Menyimpan user ID sebagai penulis
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Menampilkan detail berita
    public function show($slug)
    {
        $user = Auth::user();
        $roles = Role::all();   // Fetch all roles
        $berita = Berita::where('slug', $slug)->firstOrFail();


        $relatedBeritas = Berita::where('id', '!=', $berita->id) // Menghindari berita yang sama
            ->orderBy('tanggal_terbit', 'desc')
            ->take(3) // Ambil 3 berita terkait
            ->get();
        return view('home.partials.berita.blog', compact('berita', 'relatedBeritas' ,'user', 'roles'));
    }

    // Menampilkan form edit berita
    public function edit($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('admin.berita.edit', compact('berita'));
    }

    // Mengupdate berita di database
    public function update(Request $request, $id)
    {
        // Temukan berita berdasarkan slug
        $berita = Berita::findOrFail($id);
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string', // Pastikan isi adalah string
            'tanggal_terbit' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240', // Max 10MB
        ]);


        // Update foto jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto) {
                // dd('Menghapus foto lama: ' . $berita->foto); // Debug untuk melihat path
                Storage::disk('public')->delete($berita->foto);
            }
            // Simpan foto baru
            $berita->foto = $request->file('foto')->store('foto_berita', 'public');
        }

        // Update video jika ada file baru
        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($berita->video) {
                // dd('Menghapus video lama: ' . $berita->video); // Debug untuk melihat path
                Storage::disk('public')->delete($berita->video);
            }
            // Simpan video baru
            $berita->video = $request->file('video')->store('video_berita', 'public');
        }

        // Update data berita tanpa file
        $berita->judul = $request->input('judul'); // Gunakan input untuk menghindari masalah
        $berita->isi = $request->input('isi'); // Gunakan input untuk menghindari masalah
        $berita->tanggal_terbit = $request->input('tanggal_terbit'); // Gunakan input untuk menghindari masalah
        // Update slug hanya jika judul berubah
        if ($berita->slug !== Str::slug($request->input('judul'))) {
            $berita->slug = Str::slug($request->input('judul'));
        }
        // Simpan perubahan ke database
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita dari database
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

// Hapus foto jika ada
if ($berita->foto) {
    // dd('Menghapus foto: ', $berita->foto); // Debug untuk melihat path
    Storage::disk('public')->delete($berita->foto);
}

        // Hapus video jika ada
        if ($berita->video) {
            Storage::disk('public')->delete($berita->video);
            // dd('Video dihapus: ' . $berita->video); // Uji penghapusan video
        }

        $berita->delete();

        // dd('Berita berhasil dihapus: ' . $berita->judul); // Uji berita yang dihapus
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }

}
