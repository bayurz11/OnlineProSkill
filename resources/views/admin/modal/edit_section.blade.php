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
                    <div class="mb-3">
                        <label for="fileedit" class="form-label">Upload Materi<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="fileedit" name="file">
                        <small id="fileHelp" class="form-text text-muted">Upload hanya jika ingin mengganti
                            file.</small>
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
                    if (response.kurikulum_id) {
                        $('#kurikulum_id').val(response
                        .kurikulum_id); // Set nilai kurikulum_id di dalam modal
                    } else {
                        console.log('kurikulum_id is missing in response');
                    }
                    $('#edittitle1').val(response
                    .title); // Set nilai judul section di dalam modal
                    $('#linkedit').val(response
                    .link); // Set nilai link section di dalam modal

                    // Menetapkan pratinjau file jika ada
                    if (response.file) {
                        $('#fileHelp').html('File saat ini: <a href="' + response.file +
                            '">Download</a>');
                    } else {
                        $('#fileHelp').html('Tidak ada file yang diunggah.');
                    }

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
