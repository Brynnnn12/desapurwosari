<div>
    <form action="{{ route('surat_pengantars.updateStatus', $suratPengantar->id) }}" method="POST"
        id="statusForm-{{ $suratPengantar->id }}">
        @csrf
        @method('PATCH')
        <select name="status" id="statusSelect-{{ $suratPengantar->id }}" class="ml-2 px-2 py-1 bg-gray-200 rounded">
            <option value="">Pilih Status</option>
            <option value="disetujui" {{ $suratPengantar->status === 'disetujui' ? 'selected' : '' }}>
                Disetujui
            </option>
            <option value="ditolak" {{ $suratPengantar->status === 'ditolak' ? 'selected' : '' }}>
                Ditolak
            </option>
        </select>
    </form>
</div>

<script>
    document.querySelectorAll('[id^="statusSelect-"]').forEach(function(select) {
        let previousValue = select.value; // Simpan nilai sebelumnya

        select.addEventListener('change', function() {
            const suratId = this.id.split('-')[1];
            const selectedValue = this.value;

            // console.log("Selected Value Changed:", selectedValue); // Debugging log

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengubah status menjadi \"" + selectedValue + "\"!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log("Submitting form with ID: ", 'statusForm-' +
                    // suratId); // Log sebelum submit
                    document.getElementById('statusForm-' + suratId).submit();
                } else {
                    // console.log("Change canceled. Reverting to previous value:",
                    // previousValue); // Log ketika dibatalkan
                    this.value = previousValue; // Kembalikan ke nilai sebelumnya
                }
            });
        });

        // Update previousValue after successful submission
        select.addEventListener('change', function() {
            previousValue = this.value; // Perbarui previousValue jika perubahan diterima
        });
    });
</script>
