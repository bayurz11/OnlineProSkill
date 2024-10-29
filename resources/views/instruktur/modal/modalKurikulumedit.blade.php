<!-- Modal Edit Kurikulum -->
<div class="modal fade" id="kurikulumModalEdit" tabindex="-1" aria-labelledby="kurikulumModalEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalEditModalLabel">Edit Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editKurikulumForm">
                    @csrf
                    @method('PUT') <!-- Tambahkan ini untuk menggunakan metode PUT -->
                    <input type="hidden" name="course_id" id="edit_course_id">
                    <input type="hidden" name="id" id="edit_kurikulum_id">
                    <!-- Hidden field untuk ID kurikulum -->

                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" form="editKurikulumForm">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.editKurikulumBtn', function() {
        var id = $(this).data('id'); // Ambil ID dari tombol edit
        $.ajax({
            url: '/instruktur_kurikulum/' + id + '/edit', // Ganti dengan route edit
            type: 'GET',
            success: function(response) {
                $('#edit_kurikulum_id').val(response.id); // Set ID kurikulum
                $('#edit_course_id').val(response.course_id); // Set course_id
                $('#edittitle').val(response.title); // Set judul

                $('#kurikulumModalEdit').modal('show'); // Tampilkan modal
            },
            error: function() {
                alert('Data tidak ditemukan');
            }
        });
    });
</script>
