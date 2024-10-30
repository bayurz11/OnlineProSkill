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
                <form id="editKurikulumInstrukturForm">
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
        $('#kurikulumModalEdit').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const kurikulumId = button.data('id');

            // AJAX request untuk mendapatkan data kurikulum
            $.ajax({
                url: '/instruktur_kurikulum/' + kurikulumId + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#edit_kurikulum_id').val(response.id);
                    $('#edittitle').val(response.title);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

        $('#saveKurikulumButton').on('click', function(event) {
            event.preventDefault();

            const kurikulumId = $('#edit_kurikulum_id').val();
            const title = $('#edittitle').val();

            // AJAX request untuk update data kurikulum
            $.ajax({
                url: '/instruktur_kurikulum/' + kurikulumId,
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                data: JSON.stringify({
                    title: title
                }),
                success: function(response) {
                    if (response.success) {
                        alert('Kurikulum berhasil diperbarui');
                        $('#kurikulumModalEdit').modal('hide'); // Tutup modal
                        location.reload(); // Refresh halaman
                    } else {
                        alert('Gagal memperbarui kurikulum');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
