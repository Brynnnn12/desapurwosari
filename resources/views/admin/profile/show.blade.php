@extends('admin.layout')

@section('content')
    <div class="content ml-4 sm:ml-6 md:ml-12 transform ease-in-out duration-500 pt-10 px-4 sm:px-6 md:px-5 pb-4">
        @include('partials.alert')

        <div class="min-h-screen flex items-center justify-center px-4 sm:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
                <h2 class="text-2xl font-semibold mb-6 text-center">Profil Pengguna</h2>
                <div class="flex flex-col items-center mb-6">
                    @if($user->avatar)
                        <!-- Tampilkan gambar avatar jika tersedia -->
                        <img src="{{ Storage::url($user->avatar) }}" alt="Avatar"
    class="w-32 h-32 rounded-full border border-gray-300 mb-4 object-cover">

                    @else
                        <!-- Tampilkan ikon default jika tidak ada avatar -->
                        <span class="flex size-14 items-center justify-center overflow-hidden rounded-full border border-neutral-300 bg-neutral-50 text-neutral-600/50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300/50">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" class="w-32 h-32 mt-3">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->nik }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->pekerjaan }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">
                        {{ $user->jenis_kelamin }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Pendidikan</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->pendidikan }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->alamat }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->phone }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">{{ $user->tempat_lahir }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <p class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">
                        {{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d-m-Y') : '-' }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('profile.edit', $user->id) }}"
                        class="bg-blue-600 text-white font-semibold  px-4 py-2 rounded-md hover:bg-blue-500  text-center">Edit
                        Profil</a>

                        @include('partials.hapus', [
                            'title' => 'Akun',
                            'url' => route('profile.destroy', $user->id),
                            'class' =>
                                'ml-2 text-white font-semibold px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 ',
                                'id' => $user->id, // Kirimkan ID di sini
                        ])
                </div>



                {{-- <!-- Delete Account Button -->
                <div class="mt-6">
                    <button id="deleteAccountButton"
                        class="bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-500 w-full text-center"
                        onclick="confirmDeleteAccount({{ $user->id }})">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteAccount(userId) {
            Swal.fire({
                title: 'Konfirmasi Hapus Akun',
                text: "Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete route
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>

    <!-- Hidden Form for Deletion -->
    <form id="deleteForm" action="{{ route('profile.delete', $user->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form> --}}
            @endsection
