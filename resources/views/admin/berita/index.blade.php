@extends('admin.layout')

@section('content')

    <div class="mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Berita', 'url' => route('berita.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Berita</h3>
        </div>

        <div class="flex justify-between items-center mb-6">
            <button @click="open = true"
                class="inline-block  px-2 py-1 text-sm font-bold bg-blue-500 text-white rounded hover:bg-blue-600
                       sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-md">
                Berita Baru
            </button>

            <div class="ml-3 ">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <form action="{{ route('berita.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white w-full pr-10 h-8 pl-2 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari berita..." value="{{ request()->get('search') }}" />
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

        <div>
            @if ($beritas->isEmpty())
                @if (request()->has('search'))
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                        Tidak ada berita yang sesuai dengan pencarian "{{ request()->get('search') }}".
                    </div>
                @else
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl mt-4">
                        Tidak ada berita yang tersedia.
                    </div>
                @endif
            @else
                <div
                    class="relative flex flex-col w-full h-full overflow-y-auto max-h-[500px] text-gray-700 shadow-md rounded-lg bg-clip-border">
                    <table class="w-full text-left table-auto border min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">No.</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Judul Berita</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Slug</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Penulis</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Isi</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Foto</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Video</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Tanggal Terbit</p>
                                </th>
                                @if (auth()->user()->hasRole('admin'))
                                    <th class="p-4 border border-slate-200 bg-slate-50">
                                        <p class="text-sm font-bold text-center leading-none text-slate-500">Aksi</p>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $index => $berita)
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5 border">
                                        <p class="block font-semibold text-sm text-slate-800">{{ $index + 1 }}</p>
                                    </td>

                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $berita->judul }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $berita->slug }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ $berita->user->name ?? 'Penulis tidak ditemukan' }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ Str::limit($berita->isi, 50) }}
                                            <!-- Batasi tampilan hingga 50 karakter -->
                                        </p>
                                    </td>

                                    <td class="p-4 py-5 border">
                                        @if ($berita->foto)
                                            <img src="{{ Storage::url($berita->foto) }}" alt="Foto Berita"
                                                style="width: 100px; height: auto;">
                                        @else
                                            <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="p-4 py-5 border">
                                        @if ($berita->video)
                                            <a href="{{ Storage::url($berita->video) }}" target="_blank">Lihat Video</a>
                                        @else
                                            <span>Tidak ada video</span>
                                        @endif
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ $berita->tanggal_terbit ? $berita->tanggal_terbit->format('d-m-Y') : 'Tanggal tidak tersedia' }}
                                        </p>
                                    </td>

                                    @if (auth()->user()->hasRole('admin'))
                                        <td class="py-2 px-4 border text-center">
                                            <div class="flex justify-center space-x-2">
                                                <!-- Tombol Edit -->
                                                <button
                                                    @click="edit = true; berita = {
                                                    id: {{ $berita->id }},
                                                    slug: '{{ $berita->slug }}',
                                                    judul: '{{ $berita->judul }}',
                                                    isi: {{ json_encode($berita->isi) }},
                                                    tanggal_terbit: '{{ $berita->tanggal_terbit->format('Y-m-d') }}'

                                                }"
                                                    aria-label="Edit"
                                                    class="inline-block px-4 py-1 text-sm font-bold bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                    Edit
                                                </button>


                                                <!-- Tombol Hapus -->
                                                @include('partials.hapus', [
                                                    'title' => 'Berita',
                                                    'url' => route('berita.destroy', $berita->id),
                                                    'class' => 'ml-2 inline-block px-3 py-1 text-sm font-bold bg-red-500 text-white rounded hover:bg-red-600
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 transition duration-300',
                                                    'id' => $berita->id, // Kirimkan ID di sini
                                                ])
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-slate-500">
                            Showing <b>{{ $beritas->firstItem() }}</b> to
                            <b>{{ $beritas->lastItem() }}</b>
                            of
                            <b>{{ $beritas->total() }}</b> entries
                        </div>
                        <div class="flex space-x-1">
                            {{ $beritas->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('admin.berita.create') <!-- Modal untuk tambah berita -->
    @if (isset($berita))
        @include('admin.berita.edit')
    @endif

@endsection
