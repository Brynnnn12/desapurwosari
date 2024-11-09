<footer x-data="{ show: false }"
        x-intersect="show = true"
        class="w-full       p-4  transition-transform duration-700 transform translate-y-full"
        :class="{'translate-y-0 opacity-100': show, 'translate-y-full opacity-0': !show}"
        class="min-h-[96vh] sm:min-h-[56vh] md:min-h-[86vh]"
        >

    <div class=" px-2 pt-2 sm:px-4 sm:pt-6 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-6 lg:px-8" x-data="{ show: false }" x-intersect="show = true">
        <div class=" grid gap-10 row-gap-6 mb-2 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2" x-show="show" x-transition:enter="transition transform duration-1000" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100">
                <a href="/" aria-label="Go home" title="Desa Purwosari" class="inline-flex items-center">
                    <img src="{{ asset('assets/images.png') }}" class="w-10" alt="Logo">
                    <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Desa Purwosari</span>
                </a>
                <div class="sm:mt-3 md:mt-4 lg:mt-6 lg:max-w-sm">
                    <p class="text-sm text-gray-800">
                        Desa Purwosari terletak di kecamatan Comal, Kabupaten Pemalang, dikenal dengan keindahan alam dan keragaman budaya.
                    </p>
                </div>
            </div>

            <div x-show="show" x-transition:enter="transition transform duration-1000" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100" class="space-y-2 text-sm">
                <p class="text-base font-bold tracking-wide text-gray-900">Kontak</p>
                <div class="flex">
                    <p class="mr-1 text-gray-800">Telepon:</p>
                    <a href="tel:850-123-5021" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">(0285)-577-966</a>
                </div>
                <div class="flex">
                    <p class="mr-1 text-gray-800">Email:</p>
                    <a href="mailto:info@purwosari.com" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">info@purwosari.com</a>
                </div>
                <div class="flex">
                    <p class="mr-1 text-gray-800">Alamat:</p>
                    <a href="https://www.google.com/maps?q=balai+desa+purwosari+comal" target="_blank" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">Jln. Tuban No 1 Comal - Sragi</a>
                </div>
            </div>

            <div x-show="show" x-transition:enter="transition transform duration-1000" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100">
                <span class="text-base font-bold tracking-wide text-gray-900">Sosial Media</span>
                <div class="flex items-center mt-1 space-x-3">
                    <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                            <path d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"></path>
                        </svg>
                    </a>
                    <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                        <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                            <circle cx="15" cy="15" r="4"></circle>
                            <path d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"></path>
                        </svg>
                    </a>
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    Desa Purwosari dikenal dengan keindahan alam dan budaya yang kaya.
                </p>
            </div>
        </div>

        <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
            <p class="text-sm text-gray-600" x-show="show" x-transition:enter="transition transform duration-1000" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100">
                © Copyright 2024 Desa Purwosari. All rights reserved.
            </p>
        </div>
    </div>
</footer>
