<div class="modal fade" id="sectionModalEdit" tabindex="-1" aria-labelledby="sectionModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="createKurikulumForm" action="{{ route('instruktur_section.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModalEditLabel">Edit Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field for kurikulum_id -->
                    <input type="hidden" name="kurikulum_id" id="kurikulum_id">

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan Judul Materi Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Materi</label>
                        <input type="text" class="form-control" id="link" name="link"
                            placeholder="Masukkan link materi Anda">
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="duration" name="duration"
                            placeholder="00:00:00">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Materi</label>
                        <input type="file" class="form-control" id="file" name="file">
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
