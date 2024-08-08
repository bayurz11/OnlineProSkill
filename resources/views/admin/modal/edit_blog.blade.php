<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Form Fields -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editname" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="editemail" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editpassword" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="editpassword_confirmation"
                            name="password_confirmation">
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
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button yang memicu modal
            var userId = button.data('id'); // Ambil data dari atribut data-id

            $.ajax({
                url: '/siswa/' + userId + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editname').val(data.name);
                    $('#editemail').val(data.email);
                    $('#editpassword').val(''); // Kosongkan field password
                    $('#editpassword_confirmation').val(
                        ''); // Kosongkan field konfirmasi password

                    $('#editModalForm').attr('action', '/siswa/' +
                        userId); // Set action URL untuk form
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });

        $('#editModalForm').on('submit', function(event) {
            // Form submit akan ditangani oleh Laravel
        });
    });
</script>
