<div id="map" class="h-96 rounded-lg z-0"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mengatur tampilan peta ke lokasi sesuai Plus Code
        const map = L.map('map').setView([-6.910466423587189, 109.53910164891359], 13); // Koordinat dari Plus Code

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'

        }).addTo(map);

        // Menambahkan marker di lokasi sesuai Plus Code
        L.marker([-6.910466423587189, 109.53910164891359]).addTo(map)
            .bindPopup('Kantor Kepala Desa Purwosari Comal')
            .openPopup();
    });
</script>
