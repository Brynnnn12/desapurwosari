@extends('admin.layout')

@section('content')
    <div class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 ">
        @include('partials.alert')
        @php
            $breadcrumbs = [['name' => 'Home', 'url' => route('admin.dashboard')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="flex flex-wrap my-5 -mx-2">
            <!-- Kartu 1: Total User -->
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div
                    class="flex items-center flex-row w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                    <div class="flex text-indigo-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                        <!-- SVG Icon: Users -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6.75a3 3 0 11-5.5 0 3 3 0 015.5 0zM4.5 18.75a9 9 0 0115 0" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Total User
                        </div>
                        <div class="text-lg font-bold">
                            {{ $totalUser }} <!-- Data dari backend -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu 2: Jenis Layanan -->
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full bg-gradient-to-r from-green-500 to-blue-500 rounded-md p-3">
                    <div class="flex text-green-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                        <!-- SVG Icon: Services -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 7.5l6.75-4.5 6.75 4.5M12 15v8m-6-8v8m12-8v8" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Jenis Layanan
                        </div>
                        <div class="text-lg font-bold">
                            {{ $totalJenisLayanan }} <!-- Data dari backend -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu 3: Pengaduan -->
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full bg-gradient-to-r from-yellow-500 to-red-500 rounded-md p-3">
                    <div
                        class="flex text-yellow-500 items-center bg-white p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12">
                        <!-- SVG Icon: Complaints -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6M3 21h18M4.5 3h15a1.5 1.5 0 011.5 1.5V18a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 18V4.5A1.5 1.5 0 014.5 3z" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Pengaduan
                        </div>
                        <div class="text-lg font-bold">
                            {{ $totalPengaduan }} <!-- Data dari backend -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <!-- ... -->
    </div>
@endsection
