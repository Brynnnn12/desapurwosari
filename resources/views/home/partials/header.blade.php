<header class=" fixed top-0 left-0 right-0  z-50 font-serif ">
    <nav class="bg-white border-gray-200 px-4  lg:px-6 py-2.5 dark:bg-gray-800 font-inter " x-data="{ clicked: false }">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                <img src="{{ asset('assets/images.png') }}" class="w-10" alt="Logo">
                <span class="self-center text-lg sm:text-xl font-semibold whitespace-nowrap dark:text-white">Purwosari</span>
            </a>
            <div class="flex items-center lg:order-2">
                @auth

                    <!-- Authenticated User Menu -->
                    <div class="relative flex-none h-full text-center flex items-center justify-center rounded-lg">
                        <div class="flex space-x-2 items-center">
                            <div id="dropdownButton" class="flex-none flex justify-center">
                                <div class="w-8 h-8 flex">
                                    @if ($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}"
                                            alt="Profile picture of {{ $user->name }}"
                                            class="shadow rounded-full object-cover cursor-pointer"
                                            id="dropdownProfileButton" />
                                    @else
                                        <span
                                            class="flex size-14 items-center justify-center overflow-hidden rounded-full border border-neutral-300 bg-neutral-50 text-neutral-600/50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300/50">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                                fill="currentColor" class="w-full h-full mt-3">
                                                <path fill-rule="evenodd"
                                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="relative mt-4">
                                <div id="dropdownMenu"
                                    class="absolute right-0 z-10 hidden bg-white dark:bg-gray-800 divide-y divide-gray-100 rounded-md shadow-lg mt-4 w-48 ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-1 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                              </svg>

                                            Dashboard
                                        </a>
                                        <a href="{{ route('profile.show') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                                class="size-1 w-6">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                                            </svg>
                                            Profil
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" class="block">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="size-1 w-6">
                                                    <path fill-rule="evenodd"
                                                        d="M14 4.75A2.75 2.75 0 0 0 11.25 2h-3A2.75 2.75 0 0 0 5.5 4.75v.5a.75.75 0 0 0 1.5 0v-.5c0-.69.56-1.25 1.25-1.25h3c.69 0 1.25.56 1.25 1.25v6.5c0 .69-.56 1.25-1.25 1.25h-3c-.69 0-1.25-.56-1.25-1.25v-.5a.75.75 0 0 0-1.5 0v.5A2.75 2.75 0 0 0 8.25 14h3A2.75 2.75 0 0 0 14 11.25v-6.5Zm-9.47.47a.75.75 0 0 0-1.06 0L1.22 7.47a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06l-.97-.97h7.19a.75.75 0 0 0 0-1.5H3.56l.97-.97a.75.75 0 0 0 0-1.06Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}"
                        class="text-gray-800 dark:text-white font-sans hover:bg-gray-100 hover:text-black focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-2 sm:px-5 py-2 sm:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Masuk</a>
                    <a href="{{ route('auth.register') }}"
                        class="text-white bg-blue-700 font-sans hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 sm:px-5 py-2 sm:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Daftar</a>
                @endauth

                <button id="mobile-menu-toggle" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex font-sans flex-col mt-4 font-medium lg:flex-row lg:space-x-14 lg:mt-0">
                    {{-- @auth
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white">Dashboard</a>
                        </li>
                    @endauth --}}
                    <li>
                        <a href="{{ url('/') }}#beranda"
                            class="block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white"
                            x-on:click="clicked = true; setTimeout(() => { clicked = false; }, 300)">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}#about"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                            x-on:click="clicked = true; setTimeout(() => { clicked = false; }, 300)">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}#artikel"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                            x-on:click="clicked = true; setTimeout(() => { clicked = false; }, 300)">Berita</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}#surat"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                            x-on:click="clicked = true; setTimeout(() => { clicked = false; }, 300)">Pengajuan Surat</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}#kontak"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                            x-on:click="clicked = true; setTimeout(() => { clicked = false; }, 300)">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
