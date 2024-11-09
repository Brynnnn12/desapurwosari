@extends('admin.layout')

@section('content')

    <div class="max-w-[720px] mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Roles', 'url' => route('roles.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Roles</h3>
        </div>

        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <button @click="open = true" class="inline-block px-2 py-1 text-sm font-bold bg-blue-500 text-white rounded hover:bg-blue-600 sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-md">
                    Tambah Role
                </button>
            </div>
        </div>

        {{-- Form untuk tambah role --}}
        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white p-4 rounded shadow-lg">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="roles" class="block text-sm font-bold text-gray-700">Nama Role</label>
                    <input type="text" name="name" id="roles" required class="border border-slate-200 rounded px-2 py-1 w-full" placeholder="Masukkan nama role">
                </div>
                    <button type="submit" class="inline-block px-3 py-1 text-sm font-bold bg-green-500 text-white rounded hover:bg-green-600">
                        Simpan
                    </button>

            </form>
        </div>

        @if ($roles->isEmpty())
            <div class="alert alert-info p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl">
                Tidak ada role yang tersedia.
            </div>
        @else
            <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold leading-none text-slate-500">No.</p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold leading-none text-slate-500">Nama Role</p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50">
                                <p class="text-sm font-bold text-center leading-none text-slate-500">Aksi</p>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">{{ $index + 1 }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $role->name }}</p>
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <div class="flex justify-center space-x-2">
                                        {{-- Tombol Edit --}}
                                        <button
                @click="
                    edit = true;
                    roleId = {{ $role->id }};
                    roleName = '{{ $role->name }}';
                "
                class="inline-block px-3 py-1 text-sm font-bold bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Edit
            </button>

                                        @include('partials.hapus', [
                                            'title' => 'Role',
                                            'url' => route('roles.destroy', $role->id),
                                            'class' => 'ml-2 inline-block px-3 py-1 text-sm font-bold bg-red-500 text-white rounded hover:bg-red-600
                                                        sm:px-4 sm:py-2 sm:text-sm md:px-5 md:py-2 md:text-base lg:px-6 lg:py-2 lg:text-base transition duration-300',
                                            'id' => $role->id,
                                        ])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


    </div>
    @if (isset($role))
        @include('admin.authorize.roles.edit')
    @endif


@endsection
