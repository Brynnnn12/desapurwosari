@if (session('success'))
    <div id="success-message" style="display: none;">{{ session('success') }}</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = document.getElementById('success-message').innerText;
            if (message) {
                                // Mengatur ukuran dan padding untuk tampilan mobile dan desktop
                                let width, padding;
                let position = 'top-end';

                if (window.matchMedia("(max-width: 600px)").matches) {
                    // Ukuran untuk layar kecil (mobile)
                    width = '280px';
                    padding = '6px';  // Padding lebih kecil untuk layar kecil
                } else if (window.matchMedia("(max-width: 768px)").matches) {
                    // Ukuran untuk tablet
                    width = '360px';
                    padding = '10px';
                } else {
                    // Ukuran untuk desktop
                    width = '400px';
                    padding = '14px';
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    width: width,
                    padding: padding,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            }
        });
    </script>
@endif
