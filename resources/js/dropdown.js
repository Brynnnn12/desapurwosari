document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function(event) {
        event.stopPropagation(); // Mencegah event bubbling
        dropdownMenu.classList.toggle('hidden'); // Menampilkan atau menyembunyikan dropdown
    });

    // Menutup dropdown jika klik di luar menu
    window.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
