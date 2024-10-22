<!-- Overlay -->
<div x-show="edit" x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-200" class="fixed inset-0 bg-black bg-opacity-50 z-50 max-w-screen "
    @click="edit = false"></div>

<!-- Popup Form edit -->
<div x-show="edit" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl ml-10">
        <h2 class="text-lg font-semibold mb-4 border-b text-center ">edit Pengajuan</h2>
        <form :action="`/surat_pengantars/${suratPengantar.id}`" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ auth()->user()->name }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
            </div>

            <div class="mb-4">
                <label for="nik" class="block text-gray-700">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ auth()->user()->nik }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
            </div>

            <div class="mb-4">
                <label for="jenis_layanan_id" class="block text-gray-700">Jenis Layanan</label>
                <select id="jenis_layanan_id" name="jenis_layanan_id" class="w-full p-2 border border-gray-300 rounded"
                    required>
                    @foreach ($jenisLayanans as $jenisLayanan)
                        <option value="{{ $jenisLayanan->id }}"
                            {{ $jenisLayanan->id == $suratPengantar->jenis_layanan_id ? 'selected' : '' }}>
                            {{ $jenisLayanan->nama_layanan }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_layanan_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="berkas_pendukung" class="block text-gray-700">Berkas Pendukung</label>
                <select id="berkas_pendukung" name="berkas_pendukung" class="w-full p-2 border border-gray-300 rounded"
                    required>
                    <option value="KTP" {{ $suratPengantar->berkas_pendukung == 'KTP' ? 'selected' : '' }}>KTP
                    </option>
                    <option value="KK" {{ $suratPengantar->berkas_pendukung == 'KK' ? 'selected' : '' }}>KK</option>
                    <option value="Surat Keterangan Lainnya"
                        {{ $suratPengantar->berkas_pendukung == 'Surat Keterangan Lainnya' ? 'selected' : '' }}>
                        Surat Keterangan Lainnya
                    </option>
                </select>
                @error('berkas_pendukung')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="dokumen" class="block text-gray-700">Dokumen</label>
                <input type="file" id="dokumen" name="dokumen" value="{{$suratPengantar->dokumen}}" accept=".pdf"
                    class="w-full p-2 border border-gray-300 rounded">
                <small class="text-gray-500">* Biarkan kosong jika tidak ada dokumen baru</small>
                @error('dokumen')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="proses" {{ $suratPengantar->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="disetujui" {{ $suratPengantar->status == 'disetujui' ? 'selected' : '' }}>Disetujui
                    </option>
                    <option value="ditolak" {{ $suratPengantar->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                    </option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-2 ">
                <div class="mt-2 bg-green-500 rounded-lg">
                    <button type="submit"
                        class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
                </div>
                <div class="mt-2 bg-red-500 rounded-lg">
                    <button type="button" @click="edit = false"
                        class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
