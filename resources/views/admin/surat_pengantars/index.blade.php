@extends('admin.layout')

@section('content')

    <div class="mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @include('partials.gagal')
        @php
            $breadcrumbs = [['name' => 'Surat Pengantar', 'url' => route('surat_pengantars.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Surat Pengantar</h3>
        </div>

        <div class="flex justify-between items-center mb-6">
            <button @click="open = true"
                class="inline-block  pr-4 h-8 pl-4  px-2 py-1 text-xs font-semibold sm:font-bold bg-blue-500 text-white rounded hover:bg-blue-600
                       sm:px-3 sm:py-1.5  md:px-4 md:py-2 ">
                Surat Baru
            </button>


            <div class="ml-3 ">
                <div class="w-50   relative">
                    <form action="{{ route('surat_pengantars.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white  pr-4 h-8 pl-2  py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari surat pengantar..." value="{{ request()->get('search') }}" />
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


            @if ($suratPengantars->isEmpty())
                @if (request()->has('search'))
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                        Tidak ada Pengajuan yang sesuai dengan pencarian "{{ request()->get('search') }}".
                    </div>
                @else
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl mt-4">
                        Tidak ada Pengajuan yang tersedia.
                    </div>
                @endif
            @else
                <div
                    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 shadow-md rounded-lg bg-clip-border">
                    <table class="w-full text-left table-auto border min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">No.</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Nomor Surat</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Pengaju</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">NIK</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Jenis Layanan</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Berkas Pendukung</p>
                                </th>
                                @if(auth()->user()->hasRole('admin'))

                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Dokumen</p>
                                </th>
                                @endif
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold text-center leading-none text-slate-500">Status</p>
                                </th>
                                @if(auth()->user()->hasRole('admin'))

                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold text-center leading-none text-slate-500">Aksi</p>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratPengantars as $index => $suratPengantar)
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5 border">
                                        <p class="block font-semibold text-sm text-slate-800">{{ $index + 1 }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->nomor_surat }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ $suratPengantar->user->name ?? 'User tidak ditemukan' }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ $suratPengantar->user->nik ?? 'NIK tidak ditemukan' }}</p>
                                    </td>

                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            {{ $suratPengantar->jenisLayanan->nama_layanan ?? 'Jenis Layanan tidak ditemukan' }}
                                        </p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->berkas_pendukung }}</p>
                                    </td>
                                    @if(auth()->user()->hasRole('admin'))

                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">
                                            @if ($suratPengantar->dokumen)
                                                <a href="{{ asset('storage/' . $suratPengantar->dokumen) }}" target="_blank"
                                                    class="text-blue-500 underline">
                                                    {{ basename($suratPengantar->dokumen) }}
                                                </a>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </p>
                                    </td>
                                    @endif

                                    <td class="p-4 py-5 border flex justify-center">
                                        @if ($suratPengantar->status === 'disetujui')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 w-7">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif ($suratPengantar->status === 'ditolak')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-6 w-7">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif ($suratPengantar->status === 'proses')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-5 w-7">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </td>

                                    @if(auth()->user()->hasRole('admin'))

                                    <td class="py-2 px-4 border text-center">
                                        <div class="flex justify-center space-x-2">
                                            <!-- Tombol Edit -->
                                            {{-- <button
                                                @click="edit = true; suratPengantar = { id: '{{ $suratPengantar->id }}', name: '{{ $suratPengantar->name }}', nik: '{{ $suratPengantar->nik }}', jenis_layanan_id: '{{ $suratPengantar->jenis_layanan_id }}', berkas_pendukung: '{{ $suratPengantar->berkas_pendukung }}', dokumen: '{{ $suratPengantar->dokumen }}' ,status: '{{ $suratPengantar->status }}' }"
                                                aria-label="Edit"
                                                class="inline-block px-3 py-1 text-sm font-bold bg-yellow-500 text-white rounded hover:bg-yellow-600
                                                       sm:px-4 sm:py-2 sm:text-sm md:px-5 md:py-2 md:text-base lg:px-6 lg:py-2 lg:text-base transition duration-300">
                                                Edit
                                            </button> --}}

                                            @include('partials.ubah')


                                            <!-- Tombol Hapus -->
                                            @include('partials.hapus', [
                                                'title' => 'Surat Pengantar',
                                                'url' => route('surat_pengantars.destroy', $suratPengantar->id),
                                                'class' => 'ml-2 inline-block px-3 py-1 text-sm font-bold bg-red-500 text-white rounded hover:bg-red-600
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 transition duration-300',
                                                'id' => $suratPengantar->id, // Kirimkan ID di sini
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
                            Showing <b>{{ $suratPengantars->firstItem() }}</b> to
                            <b>{{ $suratPengantars->lastItem() }}</b>
                            of
                            <b>{{ $suratPengantars->total() }}</b> entries
                        </div>
                        <div class="flex space-x-1">
                            {{ $suratPengantars->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('admin.surat_pengantars.create') <!-- Modal untuk tambah surat pengantar -->
    @if (isset($suratPengantar))
        @include('admin.surat_pengantars.edit')
    @endif


@endsection
