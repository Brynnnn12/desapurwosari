<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Mengimpor Auth dengan benar
use Illuminate\Support\Facades\Storage; // Tambahkan ini di bagian atas

use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use App\Models\SuratPengantar;

class SuratPengantarController extends Controller
{


    // Menampilkan semua surat pengantar
    public function index(Request $request)
    {
        // Mendapatkan pengguna yang terautentikasi
        $user = Auth::user();

        // Mendapatkan semua jenis layanan
        $jenisLayanans = JenisLayanan::all();

        // Mengambil input pencarian dari request
        $search = $request->input('search');

        // Query untuk mengambil data surat pengantar beserta jenis layanannya
        $suratPengantars = SuratPengantar::with('jenisLayanan')
            ->when($search, function ($query, $search) {
                // Filter pencarian berdasarkan nomor surat, nama user, atau NIK
                return $query->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('nik', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(10); // Paginasi 10 item per halaman

        // Mengirimkan data ke view
        return view('admin.surat_pengantars.index', compact('suratPengantars', 'jenisLayanans', 'user'));
    }


    // Menampilkan form untuk membuat surat pengantar baru
    public function create()
    {

        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi

        // Ambil semua jenis layanan dari database
        $jenisLayanans = JenisLayanan::all();

        // Kirim data ke view
        return view('admin.surat_pengantars.create', compact('jenisLayanans', 'user'));
    }

    // Menyimpan surat pengantar baru ke database
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
        'berkas_pendukung' => 'required|in:KTP,KK,Surat Keterangan Lainnya',
        'dokumen' => 'required|file|mimes:pdf|max:2048', // Validasi untuk file
    ]);

    // Mendapatkan ID pengguna yang sedang login
    $userId = Auth::id();
    $userName = str_replace(' ', '_', Auth::user()->name); // Ganti spasi dengan underscore

    // Mengambil nomor antrian terakhir dari tabel surat_pengantar
    $lastSurat = SuratPengantar::whereYear('created_at', now()->year)->orderBy('id', 'desc')->first();

    // Menentukan nomor antrian berikutnya
    $nextNumber = $lastSurat ? ((int) substr($lastSurat->nomor_surat, 0, 3)) + 1 : 1;
    $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    // Format nomor surat, misalnya "001/XX/2024"
    $nomorSurat = $formattedNumber . '/XX/' . now()->year;

    // Simpan dokumen ke storage dengan nama file yang diubah
    $dokumenFileName = 'pengajuansurat_' . $userName . '_' . $formattedNumber . '.pdf'; // Format nama file dengan nomor urut
    $dokumenPath = $request->file('dokumen')->storeAs('dokumen', $dokumenFileName, 'public'); // Menyimpan dokumen ke folder 'dokumen'

    // Simpan data surat pengantar
    SuratPengantar::create([
        'user_id' => $userId,
        'nomor_surat' => $nomorSurat,
        'jenis_layanan_id' => $request->jenis_layanan_id,
        'berkas_pendukung' => $request->berkas_pendukung,
        'dokumen' => $dokumenPath, // Simpan path dokumen
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('surat_pengantars.index')->with('success', 'Surat Pengantar berhasil dibuat.');
}


    // Menampilkan detail surat pengantar
    public function show($id)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $suratPengantar = SuratPengantar::findOrFail($id);
        return view('admin.surat_pengantars.show', compact('suratPengantar', 'user'));
    }

    // Menampilkan form untuk mengedit surat pengantar
    public function edit($id)
    {
        $user = Auth::user(); // Dapatkan pengguna yang terautentikasi
        $suratPengantar = SuratPengantar::findOrFail($id);
        $jenisLayanans = JenisLayanan::all();

        return view('admin.surat_pengantars.edit', compact('suratPengantar', 'jenisLayanans', 'user'));
    }

    // Memperbarui surat pengantar di database
    public function update(Request $request, $id)
{
    // Validasi data
    $validated = $request->validate([
        'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
        // 'nomor_surat' => 'required|string|unique:surat_pengantars,nomor_surat,' . $id,
        'berkas_pendukung' => 'required|in:KTP,KK,Surat Keterangan Lainnya',
        'dokumen' => 'nullable|file|mimes:pdf|max:2048', // Validasi untuk dokumen
        'status' => 'required|in:proses,disetujui,ditolak',
    ]);

    // Cari surat pengantar yang akan di-update
    $suratPengantar = SuratPengantar::findOrFail($id);
    $suratPengantar->jenis_layanan_id = $validated['jenis_layanan_id'];
    // $suratPengantar->nomor_surat = $validated['nomor_surat'];
    $suratPengantar->berkas_pendukung = $validated['berkas_pendukung'];
    $suratPengantar->status = $validated['status'];

    // Jika ada dokumen yang diupload
    if ($request->hasFile('dokumen')) {
        // Hapus dokumen lama jika ada
        if ($suratPengantar->dokumen) {
            // Cek apakah file ada sebelum mencoba menghapus
            if (Storage::disk('public')->exists($suratPengantar->dokumen)) {
                Storage::disk('public')->delete($suratPengantar->dokumen); // Hapus file lama
            }
        }

        // Mendapatkan nama user
        $namaUser = str_replace(' ', '_', $suratPengantar->user->name); // Mengganti spasi dengan underscore
        $noUrut = $suratPengantar->no_urut; // Ambil nomor urut dari surat pengantar

        // Format nama dokumen
        $namaDokumen = 'pengajuansurat_' . $namaUser . '_' . $noUrut . '.pdf';

        // Simpan dokumen dengan nama baru
        $dokumenPath = $request->file('dokumen')->storeAs('dokumen', $namaDokumen, 'public');
        $suratPengantar->dokumen = $dokumenPath; // Simpan path dokumen baru
    }

    $suratPengantar->save();

    session()->flash('success', 'Surat pengantar berhasil diperbarui.');

    return redirect()->route('surat_pengantars.index');
}



    public function updateStatus(Request $request, $id)
{
    try {
        $suratPengantar = SuratPengantar::findOrFail($id);
        $suratPengantar->status = $request->input('status');
        $suratPengantar->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}











    // Menghapus surat pengantar dari database
    public function destroy($id)
    {
        // Mencari surat pengantar berdasarkan ID
        $suratPengantar = SuratPengantar::findOrFail($id);

        // Hapus dokumen dari storage jika ada
        if ($suratPengantar->dokumen) {
            Storage::disk('public')->delete($suratPengantar->dokumen); // Hapus file dokumen
        }

        // Hapus surat pengantar dari database
        $suratPengantar->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('surat_pengantars.index')->with('success', 'Surat Pengantar berhasil dihapus.');
    }
}
