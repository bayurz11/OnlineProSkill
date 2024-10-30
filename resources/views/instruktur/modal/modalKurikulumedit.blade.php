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
                <form id="editKurikulumInstrukturForm" method="POST">
                    @csrf
                    @method('PUT')
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
                <button type="button" class="btn btn-primary" id="saveKurikulumButton">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#saveKurikulumButton').click(function() {
            var form = $('#editKurikulumInstrukturForm');
            var formData = form.serialize(); // Mengambil data dari form

            // Mengambil ID kurikulum dari input tersembunyi
            var kurikulumId = $('#edit_kurikulum_id').val();

            $.ajax({
                url: '/instruktur_kurikulum/' + kurikulumId, // URL endpoint update
                type: 'PUT',
                data: formData,
                success: function(response) {
                    // Menampilkan pesan sukses
                    alert(response.message);

                    // Menutup modal
                    $('#kurikulumModalEdit').modal('hide');

                    // Melakukan refresh halaman
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani kesalahan
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessage += errors[key][0] +
                            '\n'; // Mengumpulkan pesan kesalahan
                        }
                    }
                    alert(errorMessage || 'Terjadi kesalahan saat memperbarui kurikulum.');
                }
            });
        });
    });
</script>
