<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purwosari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/js/app.js')


</head>

<body x-data="{
    open: '',
    isLoggedIn: @json(auth()->check()),
    suratPengantar: {},
    pengaduan: {},


}">
    @include('partials.alert')
    @include('partials.gagal')
    @include('home.partials.header')
    @include('home.partials.section')
    @include('home.partials.about')
    @include('home.partials.card')
    @include('home.partials.footer')



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
