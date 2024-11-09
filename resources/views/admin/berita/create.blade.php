<!-- Overlay -->
<div x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-200" class="fixed inset-0 bg-black bg-opacity-50 z-50"
    @click="open = false"></div>

<!-- Popup Form -->
<div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl">
        <h2 class="text-lg font-semibold mb-4 border-b text-center">Form Tambah Berita</h2>

        @include('partials.gagal') <!-- Include for displaying validation messages -->

        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Berita</label>
                <input type="text" id="judul" name="judul" class="w-full p-2 border border-gray-300 rounded"
                    required>
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700">Isi Berita</label>
                <textarea id="isi" name="isi" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                @error('isi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_terbit" class="block text-gray-700">Tanggal Terbit</label>
                <input type="date" id="tanggal_terbit" name="tanggal_terbit"
                    class="w-full p-2 border border-gray-300 rounded" required>
                @error('tanggal_terbit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700">Foto Berita</label>
                <input type="file" id="foto" name="foto" accept="image/*"
                    class="w-full p-2 border border-gray-300 rounded">
                @error('foto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                {{-- <label for="video" class="block text-gray-700">Video Berita</label> --}}
                <input type="file" id="video" name="video" accept="video/*"
                    class="w-full p-2 border border-gray-300 rounded">
                @error('video')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-2">
                <div class="mt-2 bg-green-500 rounded-lg">
                    <button type="submit"
                        class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Kirim</button>
                </div>
                <div class="mt-2 bg-red-500 rounded-lg">
                    <button type="button" @click="open = false"
                        class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
