<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan ini di <head> atau sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<section class="flex items-center h-screen p-16">
    <div class="container flex flex-col items-center">
        @include('partials.gagal')

        <div class="flex flex-col gap-6 max-w-md text-center">
            <h2 class="font-extrabold text-9xl text-gray-600 dark:text-gray-100">
                <span class="sr-only">Error</span>404
            </h2>
            <p class="text-2xl md:text-3xl dark:text-gray-300">Sorry, we couldn't find this page.</p>

            <!-- Tampilkan pesan error jika ada -->

            <a href="{{route('home.app')}}" class="px-8 py-4 text-xl font-semibold rounded bg-purple-600 text-gray-50 hover:text-gray-200">Back to home</a>
        </div>
    </div>
</section>


</body>
</html>
