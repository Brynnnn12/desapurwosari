<!-- resources/views/components/delete-button.blade.php -->

<form id="delete-form-{{ $id }}" action="{{ $url }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<button onclick="confirmDelete('{{ $id }}')"
        class="{{ $class }}">
    Hapus
</button>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: `Konfirmasi Hapus `,
            text: "Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
