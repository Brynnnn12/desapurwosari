
// public/js/notifications.js

document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
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
            title: successMessage.innerText
        });
    }
});
