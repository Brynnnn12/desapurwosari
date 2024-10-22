@extends('admin.layout')

@section('content')
    <div class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="min-h-screen flex items-center justify-center px-4 sm:px-8 mt-10">
                <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
                    <h2 class="text-2xl font-semibold mb-6 text-center">Edit Profil Pengguna</h2>
                    <div x-data="{ avatar: '{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/150' }}' }" class="flex flex-col items-center mb-6">
                        <img x-bind:src="avatar" alt="Avatar" class="w-32 h-32 rounded-full border border-gray-300 mb-4 object-cover">
                        <input type="file" name="avatar" class="mb-4" @change="if ($event.target.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => { avatar = e.target.result };
                            reader.readAsDataURL($event.target.files[0]);
                        }">
                        <button type="button" class="text-red-500 mt-2" @click="avatar = 'https://via.placeholder.com/150'; $refs.avatarInput.value = '';" x-show="avatar !== 'https://via.placeholder.com/150'">
                            Hapus Gambar
                        </button>
                    </div>


                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Masukkan nama Anda"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan email Anda" required>
                    </div>


                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password (kosongkan jika tidak
                            ingin mengubah)</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan password baru Anda">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Konfirmasi password baru Anda">
                    </div>


                    <div class="mb-4">
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Masukkan NIK Anda"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan"
                            value="{{ old('pekerjaan', $user->pekerjaan) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan pekerjaan Anda" required>
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <option value="" {{ old('jenis_kelamin', $user->jenis_kelamin) == '' ? 'selected' : '' }}>
                                Pilih jenis kelamin</option>
                            <option value="Laki-Laki"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <option value="" {{ old('pendidikan', $user->pendidikan) == '' ? 'selected' : '' }}>Pilih
                                pendidikan</option>
                            <option value="SD" {{ old('pendidikan', $user->pendidikan) == 'SD' ? 'selected' : '' }}>SD
                            </option>
                            <option value="SMP" {{ old('pendidikan', $user->pendidikan) == 'SMP' ? 'selected' : '' }}>
                                SMP
                            </option>
                            <option value="SMA/SMK"
                                {{ old('pendidikan', $user->pendidikan) == 'SMA/SMK' ? 'selected' : '' }}>
                                SMA
                            </option>
                            <option value="DIPLOMA"
                                {{ old('pendidikan', $user->pendidikan) == 'DIPLOMA' ? 'selected' : '' }}>DIPLOMA
                            </option>
                            <option value="SARJANA"
                                {{ old('pendidikan', $user->pendidikan) == 'SARJANA' ? 'selected' : '' }}>SARJANA
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan alamat Anda" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan nomor telepon Anda" required>
                    </div>

                    <div class="mb-4">
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $user->tempat_lahir) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            placeholder="Masukkan tempat lahir Anda" required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : '') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>

                    <div class="bg-blue-500 rounded-md">
                        <button type="submit"
                        class="w-full  text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                    </div>



                    @if ($errors->any())
                        <div class="mt-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mt-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewAvatar(event) {
            const avatarPreview = document.getElementById('avatarPreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
        function removeAvatar() {
            const avatarPreview = document.getElementById('avatarPreview');
            avatarPreview.src = 'https://via.placeholder.com/150'; // Atur ulang ke placeholder
            document.getElementById('avatar').value = ''; // Kosongkan input file
            document.getElementById('removeAvatar').style.display = 'none'; // Sembunyikan tombol hapus
        }

    </script>
@endsection
