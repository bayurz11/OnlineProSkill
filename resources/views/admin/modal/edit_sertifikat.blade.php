<div class="modal fade" id="editSertifikatModal" tabindex="-1" aria-labelledby="editSertifikatModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSertifikatForm" action="{{ route('sertifikat.update', ['id' => 0]) }}" method="POST"
                enctype="multipart/form-data">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('edit_gambar').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('edit_preview').setAttribute('src', e.target.result);
                    document.getElementById('edit_preview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });

    function openEditModal(sertifikat) {
        document.getElementById('edit_name').value = sertifikat.name;
        document.getElementById('edit_sertifikat_id').value = sertifikat.sertifikat_id;
        document.getElementById('edit_keterangan').value = sertifikat.keterangan;

        if (sertifikat.gambar) {
            document.getElementById('edit_preview').setAttribute('src', '/uploads/' + sertifikat.gambar);
            document.getElementById('edit_preview').style.display = 'block';
        } else {
            document.getElementById('edit_preview').style.display = 'none';
        }

        const form = document.getElementById('editSertifikatForm');
        form.action = `/sertifikat/${sertifikat.id}/update`;

        new bootstrap.Modal(document.getElementById('editSertifikatModal')).show();
    }
</script>
