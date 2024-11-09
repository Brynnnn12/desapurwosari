<div class="fixed w-full z-30 flex bg-white  p-2 items-center justify-between h-16 px-10">
    <div
        class="logo ml-12 dark:text-white transform ease-in-out duration-500 flex-none h-full flex items-center justify-center">
        <div class="flex justify-center">
            <img src="{{ asset('assets/images.png') }}" class="w-10 " alt="Logo">
        </div>
        <a href="{{ route('home') }} "class=" font-bold text-lg text-black  font-sans">Purwosari</a>
    </div>


    <div class="relative flex-none h-full text-center  flex items-center justify-center bg-blue-300 rounded-lg">
        <div class="flex space-x-3 items-center px-3">
            <div class="flex-none flex justify-center">
                <div class="w-8 h-8 flex">
                    @if($user->avatar)
                        <!-- Tampilkan gambar avatar jika tersedia -->
                        <img src="{{ Storage::url($user->avatar) }}" alt="Profile picture of {{ $user->name }}"
                            class="shadow rounded-full object-cover cursor-pointer" id="dropdownProfileButton" />
                    @else
                        <!-- Tampilkan ikon default jika tidak ada avatar -->
                        <span class="shadow rounded-full object-cover cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" class="w-full h-full">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @endif
                </div>

            </div>

            <div class="hidden md:block text-sm md:text-md text-black dark:text-white  ">{{ $user->name }}</div>

            <!-- Dropdown Menu -->
            <div class="relative">
                <button id="dropdownButton"
                    class="flex items-center text-sm text-gray-700 dark:text-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 w-4">
                        <path fill-rule="evenodd" d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z" clip-rule="evenodd" />
                      </svg>

                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu"
                    class="absolute right-0 z-10 hidden bg-white  divide-y divide-gray-100 rounded-md shadow-lg mt-4 w-48 ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1">
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <!-- Profile Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-1 w-6">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                              </svg>

                            Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <!-- Logout Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-1 w-6">
                                    <path fill-rule="evenodd" d="M14 4.75A2.75 2.75 0 0 0 11.25 2h-3A2.75 2.75 0 0 0 5.5 4.75v.5a.75.75 0 0 0 1.5 0v-.5c0-.69.56-1.25 1.25-1.25h3c.69 0 1.25.56 1.25 1.25v6.5c0 .69-.56 1.25-1.25 1.25h-3c-.69 0-1.25-.56-1.25-1.25v-.5a.75.75 0 0 0-1.5 0v.5A2.75 2.75 0 0 0 8.25 14h3A2.75 2.75 0 0 0 14 11.25v-6.5Zm-9.47.47a.75.75 0 0 0-1.06 0L1.22 7.47a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06l-.97-.97h7.19a.75.75 0 0 0 0-1.5H3.56l.97-.97a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                                  </svg>

                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
