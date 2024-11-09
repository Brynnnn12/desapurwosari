<!-- Popup Form Edit -->
<div x-show="edit" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12  max-w-xs sm:max-w-xl ml-10">
        <h2 class="text-lg font-semibold mb-4 border-b text-center">Edit Berita</h2>
        <form :action="`{{ route('berita.update', '') }}/${berita.id}`" method="POST" enctype="multipart/form-data">            @csrf
            @method('PUT')

            <div class="grid  sm:grid-cols-2 grid-cols-1 gap-4">
                <!-- Judul Berita -->
                <div>
                    <label for="judul" class="block text-gray-700">Judul</label>
                    <input type="text" id="judul" name="judul" x-model="berita.judul" required
                        class="w-full p-2 border border-gray-300 rounded">
                    @error('judul')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Terbit -->
                <div>
                    <label for="tanggal_terbit" class="block text-gray-700">Tanggal Terbit</label>
                    <input type="date" id="tanggal_terbit" name="tanggal_terbit" x-model="berita.tanggal_terbit" required
                        class="w-full p-2 border border-gray-300 rounded">
                    @error('tanggal_terbit')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Isi Berita -->
                <div class="col-span-1 sm:col-span-2">
                    <label for="isi" class="block text-gray-700">Isi Berita</label>
                    <textarea id="isi" name="isi" x-model="berita.isi" rows="5" required
                        class="w-full p-2 border border-gray-300 rounded"></textarea>
                    @error('isi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-gray-700">Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full p-2 border border-gray-300 rounded">
                    <small class="text-gray-500">* Biarkan kosong jika tidak ada foto baru</small>
                    @error('foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Video -->
                <div>
                    <label for="video" class="block text-gray-700">Video</label>
                    <input type="file" id="video" name="video" accept="video/*"
                        class="w-full p-2 border border-gray-300 rounded">
                    <small class="text-gray-500">* Biarkan kosong jika tidak ada video baru</small>
                    @error('video')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex gap-2">
                <div class="mt-2 bg-green-500 rounded-lg">
                    <button type="submit" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
                </div>
                <div class="mt-2 bg-red-500 rounded-lg">
                    <button type="button" @click="edit = false" class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
