<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purwosari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@500;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite('resources/js/app.js')
    @auth
    @vite('resources/js/dropdown.js')
    @endauth
    <style>
        [x-cloak] {
            display: none;
        }
    </style>





</head>

<body x-data="{
    isLoading: true,
    open: '',
    isLoggedIn: @json(auth()->check()),
    suratPengantar: {},
    pengaduan: {},



}" x-init="window.addEventListener('load', () => setTimeout(() => isLoading = false, 400))"class = "relative">

    <!-- Loading Screen -->
    <div x-show="isLoading" x-cloak class="fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50" x-transition:enter="transition ease-out duration-600" x-transition:leave="transition ease-in duration-500">
            <div class="relative flex  items-center">
                <div class="absolute animate-spin rounded-full h-32 w-32 border-t-4 border-b-4 border-purple-500"></div>
                <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg" alt="Loading Avatar" class="rounded-full h-28 w-28">
            </div>
    </div>
    <div x-show="!isLoading" x-cloak>
        @include('partials.alert')
        @include('partials.gagal')

        {{-- Header --}}
        @include('home.partials.header')

        {{-- Main content section --}}
        <main >
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('home.partials.footer')
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('mobile-menu-2');

            toggleButton.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
