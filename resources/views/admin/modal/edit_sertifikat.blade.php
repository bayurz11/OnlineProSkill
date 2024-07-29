<div class="modal fade" id="editSertifikatModal" tabindex="-1" aria-labelledby="editSertifikatModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSertifikatForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSertifikatModalLabel">Edit Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="edit_sertifikat_id" class="form-label">ID Sertifikat<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_sertifikat_id" name="sertifikat_id"
                            placeholder="Masukkan ID Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_gambar">Sertifikat<span class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar" name="gambar">
                    </div>
                    <img id="edit_preview" src="#" alt="Preview Sertifikat"
                        style="max-width: 100%; max-height: 200px; display: none;">
                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_keterangan" name="keterangan"
                            placeholder="Masukkan Keterangan">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#edit_gambar").change(function() {
            readURLEdit(this);
        });
    });

    function readURLEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#edit_preview').attr('src', e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function editSertifikat(id) {
        console.log('Fetching data for sertifikat ID:', id); // Debug log

        $.ajax({
            url: `/sertifikat/${id}/edit`,
            type: 'GET',
            success: function(data) {
                console.log('Data received:', data); // Debug log
                $('#edit_name').val(data.name);
                $('#edit_sertifikat_id').val(data.sertifikat_id);
                $('#edit_keterangan').val(data.keterangan);

                if (data.gambar) {
                    $('#edit_preview').attr('src', '/uploads/' + data.gambar).show();
                } else {
                    $('#edit_preview').hide();
                }

                $('#editSertifikatForm').attr('action', `/sertifikat/${id}/update`);
                $('#editSertifikatModal').modal('show');
            },
            error: function(xhr) {
                console.log('Error fetching data:', xhr); // Debug log
                alert('Gagal mengambil data sertifikat');
            }
        });
    }
</script>
