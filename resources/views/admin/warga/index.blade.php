@extends('admin.layout')

@section('content')

    <div class="mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Data Warga', 'url' => route('warga.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Warga</h3>
        </div>

        <div class="flex justify-between items-center mb-6">
            {{-- <button @click="open = true"
                class="inline-block px-2 py-1 text-sm font-bold bg-blue-500 text-white rounded hover:bg-blue-600
                       sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-md">
                Tambah Warga Baru
            </button> --}}

            <div class=" ">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <form action="{{ route('warga.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            class="bg-white w-full pr-10 h-8 pl-2 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-xs border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Cari warga..." value="{{ request()->get('search') }}" />
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
            @if ($wargas->isEmpty())
                @if (request()->has('search'))
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                        Tidak ada Warga yang sesuai dengan pencarian "{{ request()->get('search') }}".
                    </div>
                @else
                    <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl mt-4">
                        Tidak ada Warga yang tersedia.
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
                                    <p class="text-sm font-bold leading-none text-slate-500">Role</p> <!-- Kolom Role -->
                                </th>
                                <th class="p-4 border border-slate-200 bg-slate-50">
                                    <p class="text-sm font-bold leading-none text-slate-500">Aksi</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $nomorUrut = 1; // Inisialisasi nomor urut
                            @endphp

                            @foreach ($wargas as $index => $warga)
                                @if (!$warga->roles->contains('name', 'admin'))
                                    <!-- Pastikan warga bukan admin -->
                                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                                        <td class="p-4 py-5 border">
                                            <p class="block font-semibold text-sm text-slate-800">{{ $nomorUrut }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $warga->name }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $warga->nik }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $warga->tempat_lahir }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">
                                                {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d-m-Y') }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            <p class="text-sm text-slate-500">{{ $warga->alamat }}</p>
                                        </td>
                                        <td class="p-4 py-5 border">
                                            @foreach ($warga->roles as $role)
                                                <p class="text-sm text-slate-500">{{ $role->name }}</p>
                                            @endforeach
                                        </td>
                                        <td class="py-2 px-4 border text-center">
                                            <div class="flex justify-center space-x-2">
                                                @include('partials.hapus', [
                                                    'title' => 'Warga',
                                                    'url' => route('warga.destroy', $warga->id),
                                                    'class' => 'ml-2 inline-block px-3 py-1 text-sm font-bold bg-red-500 text-white rounded hover:bg-red-600
                                                                                                                                                                sm:px-4 sm:py-2 sm:text-sm md:px-5 md:py-2 md:text-base lg:px-6 lg:py-2 lg:text-base transition duration-300',
                                                    'id' => $warga->id,
                                                ]) <!-- Tombol Hapus -->

                                                <!-- Dropdown untuk mengubah role -->
                                                <!-- Dropdown untuk mengubah role -->
                                                <form id="roleForm" action="{{ route('warga.update', $warga->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- Pastikan ini adalah PUT -->
                                                    <select name="role" required
                                                        onchange="document.getElementById('roleForm').submit()">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"
                                                                {{ $warga->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" style="display: none;">Update Role</button>
                                                    <!-- Button dihidden karena tidak diperlukan -->
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-slate-500">
                            Showing <b>{{ $wargas->firstItem() }}</b> to <b>{{ $wargas->lastItem() }}</b> of
                            <b>{{ $wargas->total() }}</b>
                        </div>
                        {{ $wargas->links() }} <!-- Pagination -->
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
