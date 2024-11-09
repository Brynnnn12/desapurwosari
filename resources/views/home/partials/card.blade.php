<div  class="container mx-auto px-4 py-8 md:py-12">
    <h2 class="text-2xl md:text-3xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-6 md:mb-10">
        Jenis Layanan
    </h2>

    <div class="grid grid-cols- sm:grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
        <!-- Card 1: Pengajuan Surat -->
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <img src="https://tailwindcss.com/_next/static/media/headlessui@75.c1d50bc1.jpg" alt="Pengajuan Surat"
                class="w-full h-48 md:h-64 object-cover">
            <div class="p-4 md:p-6 flex-grow">
                <h3 class="text-lg md:text-xl font-semibold text-indigo-500 dark:text-indigo-300 mb-2">Pengajuan Surat</h3>
                <p class="text-sm md:text-base text-gray-700 dark:text-gray-300 mb-4">
                    Layanan untuk mengajukan berbagai surat seperti surat keterangan domisili, surat keterangan usaha, dan surat lainnya.
                </p>
            </div>
            <div class="p-4">
                <button @click="isLoggedIn ? (open = 'surat') : (window.location.href = '{{ route('auth.login') }}')" class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-full text-sm">
                    Ajukan Surat
                </button>
            </div>
        </div>

        <!-- Card 2: Kritik & Saran -->
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <img src="https://tailwindcss.com/_next/static/media/heroicons@75.4a558f35.jpg" alt="Pengaduan"
                class="w-full h-48 md:h-64 object-cover">
            <div class="p-4 md:p-6 flex-grow">
                <h3 class="text-lg md:text-xl font-semibold text-purple-500 dark:text-purple-300 mb-2">Kritik & Saran</h3>
                <p class="text-sm md:text-base text-gray-700 dark:text-gray-300 mb-4">
                    Layanan untuk menyampaikan kritik, saran, atau pengaduan terkait pelayanan desa atau masalah lainnya.
                </p>
            </div>
            <div class="p-4">
                <button @click="isLoggedIn ? (open = 'pengaduan') : (window.location.href = '{{ route('auth.login') }}')" class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-full text-sm">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
    </div>

    <template x-if="!isLoggedIn">
        <div class="text-center mt-6">
            <p class="text-lg mb-4">Anda perlu <a href="{{ route('auth.login') }}" class="text-indigo-500 hover:underline">login</a> untuk mengakses layanan ini.</p>
        </div>
    </template>

    <!-- Modal untuk Pengajuan Surat -->
    <div x-show="open === 'surat'" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = ''">
            @include('admin.surat_pengantars.create')

    </div>

    <!-- Modal untuk Kritik & Saran -->
    <div x-show="open === 'pengaduan'" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = ''">
            @include('admin.pengaduans.create')
    </div>
</div>
