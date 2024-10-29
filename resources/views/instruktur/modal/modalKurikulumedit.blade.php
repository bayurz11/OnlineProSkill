<div class="modal fade" id="kurikulumModalEdit" tabindex="-1" aria-labelledby="kurikulumModalEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalEditModalLabel">Edit Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('instruktur_kurikulum.store') }}" method="POST" id="createKurikulumForm">
                    @csrf
                    <!-- Hidden field for course_id -->
                    <input type="hidden" name="course_id" id="course_id">

                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" form="createKurikulumForm">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#kurikulumModalEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var kurikulumId = button.data('id'); // Ambil data-id dari tombol
            console.log('Kurikulum ID:', kurikulumId); // Debugging line

            // AJAX request untuk mengambil data kurikulum
            $.ajax({
                url: '/instruktur_kurikulum/' + kurikulumId + '/edit',
                method: 'GET',
                success: function(response) {
                    console.log(response); // Debugging line
                    $('#course_id').val(response.id); // Set nilai course_id di dalam modal
                    $('#edittitle').val(response
                        .title); // Set nilai judul kurikulum di dalam modal

                    // Set action form dengan id yang benar
                    $('#editKurikulumForm').attr('action', '/instruktur_kurikulumupdate/' +
                        kurikulumId);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
