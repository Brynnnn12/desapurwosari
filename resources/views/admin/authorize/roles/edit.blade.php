<!-- Overlay untuk Edit Form -->
<div x-show="edit" x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-200" class="fixed inset-0 bg-black bg-opacity-50 z-50"
    @click="edit = false"></div>

<!-- Edit Popup Form -->
<div x-show="edit"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-xs sm:max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Edit Role</h2>

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Nama Role</label>
                <input type="text" name="name" id="role" required  value="{{ old('role', $role->name) }}"
"
                    class="w-full h-10 border rounded p-2" placeholder="Masukkan nama role..." />
            </div>

            @foreach ($permissions as $permission)
                <div class="flex gap-2 items-center mb-4">
                    <input id="permission-checkbox-{{ $permission->id }}" type="checkbox" name="permissions[]"
                        value="{{ $permission->id }}"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                        {{$role->permissions->contains($permission) ? 'checked' : '' }}>
                    <label for="permission-checkbox-{{ $permission->id }}"
                        class="ms-2 text-sm font-medium text-gray-900">{{ $permission->name }}</label>
                </div>
            @endforeach

            <div class="flex gap-2 mb-2">
                <button type="submit"
                    class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
                <button type="button" @click="edit = false"
                    class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Batal</button>
            </div>
        </form>

    </div>
</div>
