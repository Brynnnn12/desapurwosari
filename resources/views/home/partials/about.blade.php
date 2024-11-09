<div id="about" x-data="{ isVisible: false }" >
    <section  class="relative bg-white overflow-hidden sm:mt-8 lg:mt-20">
        <div class="max-w-7xl mx-auto" >
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"></polygon>
                </svg>

                <div class="pt-1"></div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28" x-intersect="isVisible = true">
                    <div class="sm:text-center lg:text-left">
                        <h2 x-show="isVisible"
                            class="my-6 text-2xl font-sans tracking-tight font-extrabold text-gray-900 sm:text-3xl md:text-4xl transition-transform duration-1000 ease-in"
                            x-transition:enter="transition-transform ease-in duration-1000"
                            x-transition:enter-start="opacity-0 transform -translate-x-10"
                            x-transition:enter-end="opacity-100 transform translate-x-0">
                            Tentang Kami
                        </h2>

                        <p x-show="isVisible"
                            class="mt-4 font-sans text-base text-gray-600 transition-transform duration-1000 ease-in"
                            x-transition:enter="transition-transform ease-in duration-1000"
                            x-transition:enter-start="opacity-0 transform -translate-x-10"
                            x-transition:enter-end="opacity-100 transform translate-x-0">
                            Desa Purwosari Comal terletak di Kecamatan Comal, Kabupaten Pemalang, Jawa Tengah. Desa ini
                            dikenal dengan keindahan alamnya dan budaya lokal yang kaya. Masyarakatnya sebagian besar
                            berprofesi sebagai petani, mengandalkan hasil pertanian seperti padi dan sayuran.
                        </p>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img x-show="isVisible"
                class="h-56 w-full object-cover object-top sm:h-72 md:h-96 lg:w-full lg:h-full transition-transform duration-1000 ease-in"
                x-transition:enter="transition-transform ease-in duration-1000"
                x-transition:enter-start="opacity-0 transform translate-x-10"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                src="{{ asset('assets/purwosari.jpg') }}" alt="Gambar Desa">
        </div>
    </section>
</div>
