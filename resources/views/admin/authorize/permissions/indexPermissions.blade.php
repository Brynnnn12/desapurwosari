@extends('admin.layout')

@section('content')

    <div class="max-w-[720px] mx-auto content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        @php
            $breadcrumbs = [['name' => 'Permissions', 'url' => route('permissions.index')]];
        @endphp

        @include('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])

        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
            <h3 class="text-xl text-center font-bold text-slate-800">Daftar Permissions</h3>
        </div>

        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <button @click="open = true"
                    class="inline-block px-2 py-1 text-sm font-bold bg-blue-500 text-white rounded hover:bg-blue-600 sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-md">
                    Tambah Permissions
                </button>
            </div>
        </div>

        @if ($permissions->isEmpty())
            <div class="p-4 text-blue-700 bg-blue-100 border border-blue-300 rounded">
                Tidak ada permission yang tersedia.
            </div>
        @else
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 bg-gray-100 border-b">No.</th>
                            <th class="p-4 bg-gray-100 border-b">Nama Permission</th>
                            <th class="p-4 bg-gray-100 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $index => $permission)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-4">{{ $index + 1 }}</td>
                                <td class="p-4">{{ $permission->name }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button
                                            @click="edit = true; permission = { id: {{ $permission->id }}, name: '{{ $permission->name }}', roles: @json($permission->roles->pluck('id')->toArray()) };"
                                            class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                            Edit
                                        </button> @include('partials.hapus', [
                                            'title' => 'Permission',
                                            'url' => route('permissions.destroy', $permission->id),
                                            'class' =>
                                                'px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600',
                                            'id' => $permission->id,
                                        ])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-gray-500">
                        Showing <b>{{ $permissions->firstItem() }}</b> to <b>{{ $permissions->lastItem() }}</b> of
                        <b>{{ $permissions->total() }}</b> entries
                    </div>
                    <div>
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Form untuk tambah role --}}
    <!-- Overlay -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200" class="fixed inset-0 bg-black bg-opacity-50 z-50"
        @click="open = false"></div>

    <!-- Popup Form Tambah -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl ml-10">
            <h4 class="text-lg font-bold text-gray-800">Tambah Permission</h4>
            <form action="{{ route('permissions.store') }}" method="POST" class="mt-2">
                @csrf
                <div class="mb-4">
                    <label for="permission" class="block text-sm font-semibold text-gray-700">Nama Permission</label>
                    <input type="text" name="permission" id="permission"
                        class="w-full h-10 px-3 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan nama permission" required>
                    @error('permission')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-semibold text-slate-700">Pilih Role</label>
                    <select id="select-role" name="roles[]" multiple placeholder="Pilih role..."
                        class="block w-full rounded-sm cursor-pointer focus:outline-none" autocomplete="off"
                        x-init="new TomSelect($el, {
                            maxItems: 3,
                            placeholder: 'Select roles...',
                        })">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <div class="mt-2 bg-green-500 rounded-lg">
                        <button type="submit"
                            class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Simpan
                        </button>
                    </div>
                    <div class="mt-2 bg-red-500 rounded-lg">
                        <button type="button" @click="open = false"
                            class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Batal
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div x-show="edit" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl ml-10">
            <h4 class="text-lg font-bold text-gray-800">Edit Permission</h4>
            <form :action="`{{ route('permissions.update', '') }}/${permission.id}`" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_permission" class="block text-sm font-semibold text-gray-700">Nama Permission</label>
                    <input type="text" name="permission" id="edit_permission" x-model="permission.name"
                        class="w-full h-10 px-3 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Masukkan nama permission" required>

                    @error('permission')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-semibold text-slate-700">Pilih Role</label>
                    <select id="select-role" name="roles[]" multiple x-model="permission.roles" placeholder="Pilih role..."
                        class="block w-full rounded-sm cursor-pointer focus:outline-none" autocomplete="off"
                        x-init="new TomSelect($el, {
                            maxItems: 3,
                            placeholder: 'Select roles...',
                            onChange: (values) => {
                                permission.roles = values;
                                console.log(permission.roles); // Debugging
                            }
                        })">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if ($permission->roles->contains($role->id)) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('roles')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex gap-2">
                    <div class="mt-2 bg-green-500 rounded-lg">
                        <button type="submit"
                            class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Simpan
                        </button>
                    </div>
                    <div class="mt-2 bg-red-500 rounded-lg">
                        <button type="button" @click="edit = false"
                            class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('permission', () => ({
                open: false,
                edit: false,
                permission: {},

            }))
        })
    </script>
@endsection --}}
