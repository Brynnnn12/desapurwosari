<div id="beranda" x-data="{ isVisible: false }">
    <section x-intersect="isVisible = true" class="bg-center bg-cover bg-gray-700 bg-blend-multiply"
        style="background-image: url('{{ asset('assets/desa.jpg') }}')">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 x-show="isVisible"
                class="mt-8 mb-2 sm:mb-4  font-extrabold tracking-tight leading-none text-white text-xl  sm:text-4xl  lg:text-6xl transition-opacity duration-1000 delay-200 font-serif"
                x-transition:enter="transition-opacity ease-in duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                Selamat Datang Di Desa Purwosari
            </h1>
            <p x-show="isVisible"
                class="mb-4 sm:mb-8  font-normal text-gray-300 text-xs sm:text-xl sm:px-16 lg:px-48 transition-opacity duration-1000 delay-300 font-sans"
                x-transition:enter="transition-opacity ease-in duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                Buat urusan Administrasi dan Pelayanan Desa lebih simpel dengan interaksi digital Pelayanan Desa dengan
                Warga.
            </p>
            <div x-show="isVisible"
                x-transition:enter="transition-opacity ease-in duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                <button @click="isLoggedIn ? (open = 'surat') : (window.location.href = '{{ route('auth.login') }}')"
                    class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-3 py-2  rounded-full text-sm font-sans">
                    Ajukan Surat
                </button>
            </div>
        </div>
    </section>
</div>
