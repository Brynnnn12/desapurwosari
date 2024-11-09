<!-- Overlay -->
<div x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-200" class="fixed  inset-0 bg-black bg-opacity-50 z-50 max-w-screen "
    @click="open = false"></div>

<!-- Popup Form -->
<div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed  inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl ml-10">
        <h2 class="text-lg font-semibold mb-4 border-b text-center ">Form Pengajuan</h2>
        @include('partials.gagal')

        <form action="{{ route('surat_pengantars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ auth()->check() ? auth()->user()->name : '' }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nik" class="block text-gray-700">NIK</label>
                <input type="text" id="nik" name="nik"value="{{ auth()->check() ? auth()->user()->nik : '' }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
                @error('nik')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>



            <div class="mb-4">
                <label for="jenis_layanan_id" class="block text-gray-700">Jenis Layanan</label>
                <select id="jenis_layanan_id" name="jenis_layanan_id" class="w-full p-2 border border-gray-300 rounded"
                    required>
                    @foreach ($jenisLayanans as $jenisLayanan)
                        <option value="{{ $jenisLayanan->id }}">{{ $jenisLayanan->nama_layanan }}</option>
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
                    <option value="KTP">KTP</option>
                    <option value="KK">KK</option>
                    <option value="Surat Keterangan Lainnya">Surat Keterangan Lainnya</option>
                </select>
                @error('berkas_pendukung')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="dokumen" class="block text-gray-700">Upload Dokumen (PDF)</label>
                <input type="file" id="dokumen" name="dokumen" accept=".pdf"
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('dokumen')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="proses">Proses</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="flex gap-2 ">
                <div class="mt-2  bg-green-500 rounded-lg">
                    <button type="submit"
                        class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Kirim</button>
                </div>
                <div class="mt-2  bg-red-500 rounded-lg">

                    <button type="button" @click="open = false"
                        class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                </div>
            </div>
    </div>
</div>
</form>
</div>
</div>
</div>
