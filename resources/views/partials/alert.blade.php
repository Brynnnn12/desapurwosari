@if (session('success'))
    <div id="success-message" style="display: none;">{{ session('success') }}</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = document.getElementById('success-message').innerText;
            if (message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
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
