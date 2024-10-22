@if (session('error'))
    <div id="error-message" style="display: none;">{{ session('error') }}</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = document.getElementById('error-message').innerText;
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
                    icon: "error", // Change to "error" for error messages
                    title: message
                });
            }
        });
    </script>
@endif
