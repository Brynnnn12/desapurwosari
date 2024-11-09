<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purwosari</title>
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
            @include('partials.alert')
            @include('partials.gagal')



            <form method="POST" action="{{ route('forgot-password-proses') }}">                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                    </label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com" required>
                </div>


                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Reset</button>
            </form>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
