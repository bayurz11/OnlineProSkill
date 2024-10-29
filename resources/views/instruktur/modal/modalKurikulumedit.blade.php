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
                <form action="{{ route('instruktur_kurikulum.update', 'id') }}" method="POST"
                    id="editKurikulumInstrukturForm">
                    @csrf
                    @method('PUT') <!-- Metode PUT untuk pembaruan -->
                    <input type="hidden" name="course_id" id="edit_course_id">
                    <input type="hidden" name="id" id="edit_kurikulum_id">

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            const kurikulumId = $(this).data('id'); // Mengambil ID dari tombol edit

            $.ajax({
                url: `/instruktur_kurikulum/${kurikulumId}/edit`, // Menggunakan route yang telah didefinisikan
                type: 'GET',
                success: function(response) {
                    // Mengisi data ke dalam modal
                    $('#edit_kurikulum_id').val(response.id); // Set ID kurikulum
                    $('#edittitle').val(response.title); // Set judul kurikulum
                    $('#edit_course_id').val(response.course_id); // Set course_id jika ada

                    // Menampilkan modal
                    $('#kurikulumModalEdit').modal('show');
                },
                error: function(xhr) {
                    alert(xhr.responseJSON
                        .message); // Menampilkan pesan error jika kurikulum tidak ditemukan
                }
            });
        });
    });
</script>
