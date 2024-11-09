<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purwosari</title>
    <!-- Memuat CSS menggunakan Vite -->
    @vite('resources/css/app.css')

    <!-- Memuat Bootstrap Icons dan SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />

    <!-- Anda bisa menambahkan stylesheet lain jika perlu -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" /> --}}
</head>

<body x-data="{
    open: false,
    edit: false,
    pengaduan: {},
    jenisLayanan: {},
    suratPengantar: {},
    profile: {},
    roles: { id: null, name: '', permissions: [] },
    permission: { name: '', roles: [] },
    berita: {},
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

    <!-- Footer -->
    @include('admin.components.footer') <!-- Footer di bawah konten -->

    <!-- Memuat JavaScript menggunakan Vite -->
    @vite('resources/js/app.js')
    @vite(['resources/js/dropdown.js', 'resources/js/sidebar.js'])

    <!-- Memuat SweetAlert, dropdown.js, dan sidebar.js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
