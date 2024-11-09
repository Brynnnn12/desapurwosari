@extends('admin.layout')

@section('content')

    <div class="mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Data Admin', 'url' => route('pegawai.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Admin</h3>
        </div>

        <div class="flex justify-between items-center mb-6">
          <div>
            <div class="w-full max-w-sm min-w-[200px] relative">
                <form action="{{ route('pegawai.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search"
                        class="bg-white w-full pr-10 h-8 pl-2 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                        placeholder="Cari pegawai..." value="{{ request()->get('search') }}" />
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
            @if ($admins->isEmpty())
                @if (request()->has('search'))
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                        Tidak ada Admin yang sesuai dengan pencarian "{{ request()->get('search') }}".
                    </div>
                @else
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl mt-4">
                        Tidak ada Admin yang tersedia.
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
                                    <p class="text-sm font-bold leading-none text-slate-500">Nama</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">NIK</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Tempat Lahir</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Tanggal Lahir</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Alamat</p>
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Role</p>
                                </th>
                                {{--
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Aksi</p>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomorUrut = 1; // Inisialisasi nomor urut
                            @endphp

                            @foreach ($admins as $admin)
                                @if (!$admin->roles->contains('name', 'user')) <!-- Pastikan admin bukan user -->
                                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                                        <td class="p-4 py-5 border">
                                            <p class="block font-semibold text-sm text-slate-800">{{ $nomorUrut }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $admin->name }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ substr_replace($admin->nik, 'xxxxxxxxxxxxxx', 0, 14) }}</p>
                                        </td>
                                                                                <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $admin->tempat_lahir }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">xx-xx-xx{{ \Carbon\Carbon::parse($admin->tanggal_lahir)->format('y') }}</p>
                                        </td>

                                                                                <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $admin->alamat }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            @foreach ($admin->roles as $role)
                                                <p class="text-sm uppercase  text-slate-500">{{ $role->name }}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @php
                                        $nomorUrut++; // Tambahkan nomor urut untuk admin yang ditampilkan
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>

                    </table>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-slate-500">
                            Showing <b>{{ $admins->firstItem() }}</b> to <b>{{ $admins->lastItem() }}</b> of
                            <b>{{ $admins->total() }}</b>
                        </div>
                        {{ $admins->links() }} <!-- Pagination -->
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
