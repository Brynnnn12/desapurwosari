    <!-- Overlay -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 max-w-screen" @click="open = false"></div>

    <!-- Popup Form -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl ml-10">
            <h2 class="text-lg font-semibold mb-4">Form Jenis Layanan</h2>
            <form action="{{ route('jenis_layanans.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                    <input type="text" name="nama_layanan" required class="w-full h-10 border border-gray-300 rounded p-2"
                        placeholder="Masukkan nama layanan...">
                </div>
                <div class="flex gap-2">
                    <div class="mt-2 bg-green-500 rounded-lg">
                        <button type="submit"
                            class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
                    </div>
                    <div class="mt-2 bg-red-500 rounded-lg">
                        <button type="button" @click="open = false"
                            class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
