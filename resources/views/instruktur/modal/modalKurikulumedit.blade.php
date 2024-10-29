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
                <form action="" method="POST" id="editKurikulumInstrukturForm">
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
                <button type="submit" class="btn btn-primary" form="editKurikulumInstrukturForm">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Tangani saat modal dibuka
    $('#kurikulumModalEdit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var id = button.data('id'); // Ambil ID kurikulum dari data-id

        // Lakukan permintaan AJAX untuk mendapatkan data kurikulum
        $.ajax({
            url: '/instruktur_kurikulum/' + id + '/edit', // Endpoint untuk mengedit kurikulum
            method: 'GET',
            success: function(data) {
                // Mengisi form dengan data yang diterima
                $('#edit_kurikulum_id').val(data.id); // Mengisi ID kurikulum
                $('#edittitle').val(data.title); // Mengisi judul kurikulum
                $('#edit_course_id').val(data.course_id); // Mengisi course_id jika perlu
                // Pastikan modal terbuka setelah data diisi
            },
            error: function(xhr) {
                // Menangani error
                console.error('Data tidak ditemukan', xhr);
                alert('Kurikulum tidak ditemukan.');
            }
        });
    });
</script>
