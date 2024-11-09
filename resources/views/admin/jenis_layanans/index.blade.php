@extends('admin.layout')

@section('content')

    <div class=" mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Jenis Layanan', 'url' => route('jenis_layanans.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <!-- Konten lainnya -->



        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Jenis Layanan</h3>

        </div>

        {{-- <div class=" flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <button @click="open = true"
                    class="inline-block  pr-4 h-8 pl-4  px-2 py-1 text-xs font-semibold sm:font-bold bg-blue-500 text-white rounded hover:bg-blue-600
                       sm:px-3 sm:py-1.5  md:px-4 md:py-2">
                    Tambah Layanan
                </button>


            </div>
            <div class="ml-3 ">
                <div class="w-50 relative">
                    <form action="{{ route('jenis_layanans.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white w-full pr-4 h-8 pl-2  py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari pengaduan..." value="{{ request()->get('search') }}" />
                        <button type="submit"
                            class="absolute h-6 w-6 right-2 top-1.5 my-auto flex items-center justify-center bg-white rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="flex justify-between items-center mb-6">
            <!-- Tombol untuk menampilkan form pengaduan -->
            <button @click="open = true"
                class="inline-block  pr-4 h-8 pl-4  px-2 py-1 text-xs font-semibold sm:font-bold bg-blue-500 text-white rounded hover:bg-blue-600
                       sm:px-3 sm:py-1.5  md:px-4 md:py-2 ">
                Layanan Baru
            </button>

            <div class="ml-3 ">
                <div class="w-50  relative">
                    <form action="{{ route('jenis_layanans.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white w-full pr-4 h-8 pl-2  py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari pengaduan..." value="{{ request()->get('search') }}" />
                        <button type="submit"
                            class="absolute h-6 w-6 right-2 top-1.5 my-auto flex items-center justify-center bg-white rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

       <div class="">
        @if ($jenisLayanans->isEmpty())
            @if (request()->has('search'))
                <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                    Tidak ada layanan yang sesuai dengan pencarian "{{ request()->get('search') }}".
                </div>
            @else
                <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                    Tidak ada layanan yang tersedia.
                </div>
            @endif
        @else
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700  shadow-md rounded-lg bg-clip-border">

                <table class="w-full  text-left table-auto min-w-max">

                    <thead>

                        <tr>
                            <th class="p-4 border border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold leading-none text-slate-500">
                                    No.
                                </p>
                            </th>
                            <th class="p-4 border border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold leading-none text-slate-500">
                                    Nama Layanan
                                </p>
                            </th>


                            <th class="p-4 border border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold text-center leading-none text-slate-500">
                                    Aksi </p>
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($jenisLayanans as $index => $jenis)
                            <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5 border">
                                    <p class="block font-semibold text-sm text-slate-800">{{ $index + 1 }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">
                                        {{ $jenis->nama_layanan }}
                                    </p>
                                </td>

                                <td class="py-2 px-4 border text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button
                                            @click="edit = true; jenisLayanan = { id: {{ $jenis->id }}, nama_layanan: '{{ $jenis->nama_layanan }}' }"
                                            aria-label="Edit"
                                            class="inline-block px-4 py-1 text-sm font-bold bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
                                        </button>

                                        @include('partials.hapus', [
                                            'title' => 'Pengaduan',
                                            'url' => route('jenis_layanans.destroy', $jenis->id),
                                            'class' => 'ml-2 inline-block px-3 py-1 text-sm font-bold bg-red-500 text-white rounded hover:bg-red-600
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 transition duration-300',
                                            'id' => $jenis->id, // Kirimkan ID di sini
                                        ])
                                        {{-- <button
                                        onclick="openModal({{ $pengaduan->id }}, '{{ route('jenis_layanans.destroy', '') }}/')"
                                        class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200">Hapus</button> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-slate-500">
                        Showing <b>{{ $jenisLayanans->firstItem() }}</b> to <b>{{ $jenisLayanans->lastItem() }}</b> of
                        <b>{{ $jenisLayanans->total() }}</b> entries
                    </div>
                    <div class="flex space-x-1">
                        {{ $jenisLayanans->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>
    @include('admin.jenis_layanans.create')
    @if (isset($jenisLayanans))
        @include('admin.jenis_layanans.edit')
    @endif



@endsection
