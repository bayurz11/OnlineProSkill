<!-- Edit Modal -->
<div class="modal fade" id="editModalsiswa" tabindex="-1" aria-labelledby="editModalsiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <<form id="editModalsiswa" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalsiswaLabel">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editname" name="name">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editemail" name="email">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Tangal Lahir <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="editdate_of_birth" name="date_of_birth">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gender" class="form-label">gender <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editgender" name="gender">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">No.HP <span class="text-danger">*</span></label>
                        <input type="tel" maxlength="12" class="form-control" id="editphone_number"
                            name="phone_number">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat<span class="text-danger">*</span></label>
                        <input type="text" maxlength="12" class="form-control" id="editaddress" name="address">
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
        $('#editModalsiswa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button yang memicu modal
            var userId = button.data('userid'); // Ambil data dari atribut data-userid

            $.ajax({
                url: '/siswa/' + userId + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editname').val(data.name);
                    $('#editemail').val(data.email);
                    $('#editdate_of_birth').val(data.userProfile.date_of_birth);
                    $('#editgender').val(data.userProfile.gender);
                    $('#editphone_number').val(data.userProfile.phone_number);
                    $('#editaddress').val(data.userProfile.address);

                    $('#editModalsiswaForm').attr('action', '/siswa/' +
                    userId); // Set action URL untuk form
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
