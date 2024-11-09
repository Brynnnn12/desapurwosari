<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Desa Purwosari</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header class="border-b p-4">
            <a href="#" class="flex items-center">
                <img src="{{ asset('assets/images.png') }}" class="w-10" alt="Desa Purwosari Logo">
                <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Desa Purwosari</span>
            </a>
        </header>

        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Halo, {{ $user->name }}</h2>

            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.
            </p>

            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Untuk mengatur ulang password Anda, klik tombol di bawah ini:
            </p>

            <a href="{{ url('/reset-password/' . $token) }}" class="inline-block px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                Reset Password
            </a>

            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Jika Anda tidak meminta reset password, abaikan email ini.
            </p>

            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Terima kasih, <br>
                Tim Desa Purwosari
            </p>
        </main>

        <footer class="mt-8">
            <p class="mt-3 text-gray-500 dark:text-gray-400">© {{ date('Y') }} Desa Purwosari. All Rights Reserved.</p>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
