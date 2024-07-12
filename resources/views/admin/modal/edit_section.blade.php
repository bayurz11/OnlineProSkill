<!-- Modal untuk Edit Kurikulum -->
<div class="modal fade" id="sectionModalEdit" tabindex="-1" aria-labelledby="sectionModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSectionForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="course_id" id="course_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModalEditLabel">Edit Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
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
                    $('#course_id').val(response.id); // Set nilai course_id di dalam modal
                    $('#edittitle').val(response
                        .title); // Set nilai judul section di dalam modal

                    // Set action form dengan id yang benar
                    $('#editSectionForm').attr('action', '/sectionupdate/' +
                        sectionId);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
