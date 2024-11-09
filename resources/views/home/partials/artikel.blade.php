<section class="py-10" x-data="{
    efek: false,
    currentIndex: 0,
    totalItems: 0,
    visibleCards: 1, // Default untuk mobile
    autoSlide: null,
    init() {
        this.totalItems = {{ isset($beritas) ? $beritas->count() : 0 }}; // Set total items
        this.updateVisibleCards(); // Perbarui visibleCards sesuai ukuran layar
        this.startAutoSlide(); // Start automatic sliding
        window.addEventListener('resize', this.updateVisibleCards); // Tambahkan event listener untuk resize
    },
    updateVisibleCards() {
        this.visibleCards = window.innerWidth < 640 ? 1 : 3; // Atur jumlah card yang terlihat berdasarkan lebar layar
    },
    next() {
        // Geser satu card ke kanan
        this.currentIndex = (this.currentIndex + 1) % (this.totalItems + 1); // TotalItems tanpa cloning
        if (this.currentIndex === this.totalItems) {
            // Jika sudah mencapai card terakhir, kembali ke card pertama
            setTimeout(() => {
                this.currentIndex = 0; // Kembali ke indeks 0 setelah delay
            }, 300); // Waktu delay sebelum kembali
        }
        this.resetAutoSlide(); // Reset the interval
    },
    prev() {
        // Geser satu card ke kiri
        this.currentIndex = (this.currentIndex - 1 + (this.totalItems + 1)) % (this.totalItems + 1); // Menambahkan 1 untuk card cloned
        if (this.currentIndex < 0) {
            this.currentIndex = this.totalItems - 1; // Kembali ke card terakhir jika sebelumnya adalah card pertama
        }
        this.resetAutoSlide(); // Reset the interval
    },
    startAutoSlide() {
        this.autoSlide = setInterval(() => {
            this.next(); // Call next method
        }, 3000); // Change slide every 5 seconds
    },
    resetAutoSlide() {
        clearInterval(this.autoSlide); // Clear the existing interval
        this.startAutoSlide(); // Restart the interval
    }
}" x-intersect = "efek =  true">
    <div id="artikel" class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 font-sans transition-transform duration-1000 "
         :class="{'translate-y-0 opacity-100': efek, 'translate-y-10 opacity-0': !efek}" >
        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-gray-900 text-center mb-12">Berita Desa</h2>

        <div class="relative">
            <!-- Carousel items -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-1000 " :style="'transform: translateX(-' + (currentIndex * (100 / (window.innerWidth < 640 ? 1 : 3))) + '%)'">
                    @if (isset($beritas) && $beritas->isNotEmpty())
                        @foreach ($beritas as $berita)
                            <div class="flex-none w-full sm:w-1/3 p-2">
                                <div class="group cursor-pointer border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600 h-full">
                                    <a href="{{ route('berita.show', ['slug' => $berita->slug]) }}">
                                        <div class="flex items-center mb-6">
                                            <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'default-image-url.jpg' }}" alt="{{ $berita->judul }}" class="rounded-lg w-full object-cover h-48 md:h-60">
                                        </div>
                                        <div class="block">
                                            <h4 class="text-gray-900 font-medium sm:text-xs lg:text-lg leading-8 mb-4">{{ $berita->judul }}</h4>
                                            <div class="flex items-center justify-between font-medium">
                                                <span class="text-sm text-indigo-600">{{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($beritas as $berita)
                        <div class="flex-none w-full sm:w-1/3 p-2">
                            <div class="group cursor-pointer border border-gray-300 rounded-2xl p-5 transition-all duration-300  hover:border-indigo-600 h-full ">
                                <a href="{{ route('berita.show', ['slug' => $berita->slug]) }}">
                                    <div class="flex items-center mb-6">
                                        <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'default-image-url.jpg' }}" alt="{{ $berita->judul }}" class="rounded-lg w-full object-cover h-48 md:h-60">
                                    </div>
                                    <div class="block">
                                        <h4 class="text-gray-900 font-sans font-medium sm:text-xs lg:text-lg leading-8 mb-4">{{ $berita->judul }}</h4>
                                        <div class="flex items-center justify-between font-medium">
                                            <span class="text-sm font-sans text-indigo-600">{{ \Carbon\Carbon::parse($berita->tanggal_terbit)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <p class="col-span-full text-center">Tidak ada berita untuk ditampilkan.</p>
                    @endif
                </div>
            </div>

            <!-- Tombol navigasi -->
            <button @click="prev()" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="next()" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>
