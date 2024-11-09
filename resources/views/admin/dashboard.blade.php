@extends('admin.layout')

@section('content')
    <div class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 ">
        @include('partials.alert')
        @php
            $breadcrumbs = [['name' => 'Home', 'url' => route('admin.dashboard')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="mb-5">
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h1>
            @foreach ($user->roles as $role)
            <p class="text-gray-600">Anda sedang berada di dashboard {{ $role->name }}. Silakan pilih menu di bawah untuk melanjutkan.</p>

        @endforeach

        </div>
        <div class="flex flex-wrap my-5 -mx-2">
            <!-- Kartu 1: Total User -->
            @if (auth()->user()->hasRole('admin'))
                <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                            <!-- SVG Icon: Users -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                              </svg>

                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Total User
                            </div>
                            <div class="text-lg font-bold">
                                <a href="{{ route('warga.index') }}" class="text-white hover:underline">
                                    {{ $totalUser }} <!-- Data dari backend -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Kartu 1: Pengaduan -->
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full bg-gradient-to-r from-yellow-500 to-red-500 rounded-md p-3">
                    <div
                        class="flex text-yellow-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                        <!-- SVG Icon: Complaints -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                          </svg>

                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Pengaduan
                        </div>
                        <div class="text-lg font-bold">
                            <a href="{{ route('pengaduans.index') }}" class="text-white hover:underline">
                                {{ $totalPengaduan }} <!-- Data dari backend -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu 2: Surat Pengantar -->
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <a href="{{ route('surat_pengantars.index') }}" class="text-white hover:underline">

                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r from-blue-500 to-teal-500 rounded-md p-3">
                        <div
                            class="flex text-blue-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                            <!-- SVG Icon: Letter -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                              </svg>

                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Surat Pengantar
                            </div>
                            <div class="text-lg font-bold">
                                {{ $totalSurat }} <!-- Data dari backend -->

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        <!-- ... -->
    </div>
@endsection
