<!DOCTYPE html>
<html lang="id"> <!-- Mengubah lang ke 'id' untuk bahasa Indonesia -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purwosari - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Selamat Datang!</h1>
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images.png') }}" class="w-20" alt="Logo">
            </div>

            @include('partials.alert') <!-- Pesan sukses atau informasi -->
            @include('partials.gagal') <!-- Pesan kesalahan umum -->

            <!-- Form reset password -->
            <form method="POST" action="{{ route('reset-password-proses') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}"> <!-- Tambahkan token di sini -->

                <!-- Input Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required aria-describedby="passwordHelp">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required aria-describedby="passwordConfirmationHelp">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
