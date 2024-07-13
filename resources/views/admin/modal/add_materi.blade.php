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
                        <label for="link" class="form-label">Link Materi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="link" name="link"
                            placeholder="Masukkan link materi Anda">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Upload Materi<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="link" name="link"
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
</script>
