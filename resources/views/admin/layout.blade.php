<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purwosari</title>
    <!-- CDN untuk Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
    <!-- Stylesheet Vite -->
    @vite('resources/css/app.css')
    @vite('resources/css/styles.css')
    @vite('resources/js/app.js')



</head>

<body x-data="{
    open: false,
    edit: false,
    pengaduan: {},
    jenisLayanan: {

    },
    suratPengantar: {},
    roleName: {  },
    permission: {},

    buka: false,
    image: ''


}" class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex">
        <!-- Sidebar -->
        @include('partials.alert')
        @include('partials.gagal')

        @include('admin.components.sidebar')

        @include('admin.components.navbar') <!-- Navbar di atas konten -->


        <!-- Main Content -->
        <main class="container mx-auto px-4 sm:px-6 md:px-8">
            @yield('content')

        </main>



    </div>

    @include('admin.components.footer') <!-- Navbar di atas konten -->

    <!-- Skrip Vite -->
    @vite('resources/js/dropdown.js')
    @vite('resources/js/sidebar.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Tom Select
            const tomSelectInstance = new TomSelect('#select-role', {
                maxItems: 3, // Set max number of selections if needed
                placeholder: 'Select roles...',
            });
        });
    </script> --}}


</body>

</html>
