<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <form id="editKurikulumForm">
                <input type="hidden" id="course_id" name="course_id">
                <div class="mb-3">
                    <label for="edittitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="edittitle" name="title">
                </div>
                <!-- Tambahkan input lain jika perlu -->
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Set ID to hidden input when showing edit modal
        $('#exampleModalEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var kurikulumId = button.data('id');
            $('#course_id').val(kurikulumId); // Pastikan ada elemen dengan id 'course_id'

            $.ajax({
                url: '/kurikulum/' + kurikulumId + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#edittitle').val(response
                        .title); // Pastikan ada elemen dengan id 'edittitle'
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
