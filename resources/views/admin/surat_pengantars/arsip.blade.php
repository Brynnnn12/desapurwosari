@extends('admin.layout')

@section('content')

    <div class="mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Arsip Surat Pengantar', 'url' => route('surat_pengantars.archive')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Arsip Surat Pengantar</h3>
        </div>

        <div class="flex justify-between items-center mb-6">
            <div class="ml-3 ">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <form action="{{ route('surat_pengantars.archive') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white w-full pr-10 h-8 pl-2 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari arsip surat pengantar..." value="{{ request()->get('search') }}" />
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
            @if ($arsipSuratPengantars->isEmpty())
                @if (request()->has('search'))
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                        Tidak ada arsip yang sesuai dengan pencarian "{{ request()->get('search') }}".
                    </div>
                @else
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl mt-4">
                        Tidak ada arsip yang tersedia.
                    </div>
                @endif
            @else
                <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 shadow-md rounded-lg bg-clip-border">
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
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold text-center leading-none text-slate-500">Status</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsipSuratPengantars as $index => $suratPengantar)
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5 border">
                                        <p class="block font-semibold text-sm text-slate-800">{{ $index + 1 }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->nomor_surat }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->user->name ?? 'User tidak ditemukan' }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->user->nik ?? 'NIK tidak ditemukan' }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->jenisLayanan->nama_layanan ?? 'Jenis Layanan tidak ditemukan' }}</p>
                                    </td>
                                    <td class="p-4 py-5 border">
                                        <p class="text-sm text-slate-500">{{ $suratPengantar->berkas_pendukung }}</p>
                                    </td>
                                    <td class="p-4 py-5 border flex justify-center">
                                        @if ($suratPengantar->status === 'disetujui')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 w-7">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                            </svg>
                                        @elseif ($suratPengantar->status === 'ditolak')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 w-7">
                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                            </svg>
                                        @elseif ($suratPengantar->status === 'proses')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 w-7">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v4.25H5.75a.75.75 0 0 0 0 1.5h4.25v4.25a.75.75 0 0 0 1.5 0V7.25h4.25a.75.75 0 0 0 0-1.5H10.75V4.191Z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $arsipSuratPengantars->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
