<!-- Modal untuk Edit Kurikulum -->
<div class="modal fade" id="sectionModalEdit" tabindex="-1" aria-labelledby="sectionModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSectionForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="kurikulum_id" name="kurikulum_id">
                    <div class="mb-3">
                        <label for="edittitle1" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle1" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>
                    <div class="mb-3">
                        <label for="linkedit" class="form-label">Link Materi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="linkedit" name="link"
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
    $(document).ready(function() {
        $('#sectionModalEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var sectionId = button.data('id'); // Ambil data-id dari tombol
            console.log('section ID:', sectionId); // Debugging line

            // AJAX request untuk mengambil data section
            $.ajax({
                url: '/section/' + sectionId + '/edit',
                method: 'GET',
                success: function(response) {
                    console.log(response); // Debugging line

                    $('#edittitle1').val(response
                        .title); // Set nilai judul section di dalam modal
                    $('#linkedit').val(response
                        .link); // Set nilai link section di dalam modal

                    // Set action form dengan id yang benar
                    $('#editSectionForm').attr('action', '/sectionupdate/' + sectionId);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
