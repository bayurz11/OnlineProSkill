<!-- Modal Tambah Kurikulum -->
<div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="materiForm" action="{{ route('section.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="materiModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="kurikulum_id" name="kurikulum_id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Materi</label>
                        <input type="text" class="form-control" id="link" name="link"
                            placeholder="Masukkan link materi Anda">
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="duration" name="duration"
                            placeholder="00:00:00">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Materi</label>
                        <input type="file" class="form-control" id="file" name="file"
                            placeholder="Masukkan link materi Anda">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#materiModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var kurikulumId = button.data('id'); // Ambil data-id dari tombol
            console.log('Kurikulum ID:', kurikulumId); // Debugging line

            var modal = $(this);
            modal.find('.modal-body #kurikulum_id').val(kurikulumId);
        });
    });
    document.getElementById('duration').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9:]/g, ''); // Hanya izinkan angka dan tanda titik dua
        let parts = value.split(':').map(Number); // Pisahkan berdasarkan tanda titik dua dan ubah menjadi angka

        // Menangani format jam:menit:detik
        if (parts.length === 1 && parts[0] > 59) {
            parts[1] = parts[0] % 60;
            parts[0] = Math.floor(parts[0] / 60);
        } else if (parts.length === 2 && parts[1] > 59) {
            parts[2] = parts[1] % 60;
            parts[1] = Math.floor(parts[1] / 60);
        }

        // Format kembali menjadi string dengan leading zero jika perlu
        value = parts.map(part => part.toString().padStart(2, '0')).join(':');

        // Set kembali nilai input field
        e.target.value = value;
    });
</script>
