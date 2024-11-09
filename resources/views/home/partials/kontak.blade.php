<section id="kontak" class="bg-gray-100" x-data="{ show: false }" x-intersect="show = true">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8 transition-transform duration-1000 transform"
         :class="{'translate-y-0 opacity-100': show, 'translate-y-10 opacity-0': !show}">
        <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-serif font-extrabold text-gray-900">Kontak</h2>
            <p class="mt-1 sm:mt-4 font-sans text-xs sm:text-lg text-gray-500">Kunjungi Kantor Balai Desa Purwosari, Comal, Pemalang.</p>
        </div>
        <div class="mt-16 sm:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Peta -->
                <div class="rounded-lg overflow-hidden z-0 w-full h-96">
                    @include('partials.map')
                </div>

                <!-- Informasi Kontak -->
                <div class=" rounded-lg overflow-hidden z-0 mt-1 sm:mt-6">
                    <div class="px-6 py-4">
                        <h3 class="text-md sm:text-lg font-serif font-medium text-gray-900">Alamat</h3>
                        <p class="mt-1 text-xs sm:text-lg font-sans text-gray-600">Jln. Tuban No 1 Comal - Sragi</p>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-md sm:text-lg  font-serif font-medium text-gray-900">Jam Pelayanan</h3>
                        <p class="mt-1 text-xs sm:text-lg font-sans text-gray-600">Senin - Jumat : 08:00 - 15:00</p>
                        <p class="mt-1  text-xs sm:text-lg font-sans text-gray-600">Sabtu - Minggu: Tutup!</p>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-md sm:text-lg font-serif font-medium text-gray-900">Kontak</h3>
                        <p class="mt-1 text-xs sm:text-lg font-sans text-gray-600">Email: info@example.com</p>
                        <p class="mt-1 text-xs sm:text-lg font-sans text-gray-600">Phone: (0285)-577-966</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
