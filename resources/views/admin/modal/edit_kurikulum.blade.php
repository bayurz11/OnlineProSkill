<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="kurikulumForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="course_id" id="course_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalEditLabel">Edit Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul<span class="text-danger">*</span></label>
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
        $('#exampleModalEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var kurikulumId = button.data('id'); // Extract info from data-* attributes

            console.log('Kurikulum ID:', kurikulumId);

            // Set the hidden input field value
            $('#course_id').val(kurikulumId);

            // Fetch the data for the specific kurikulum
            $.ajax({
                url: '/kurikulum/' + kurikulumId + '/edit',
                method: 'GET',
                success: function(response) {
                    // Fill the form fields with the response data
                    $('#edittitle').val(response.title);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
