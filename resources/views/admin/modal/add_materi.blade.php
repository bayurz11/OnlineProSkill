<!-- Modal Tambah Kurikulum -->
<div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="kurikulumForm" action="{{ route('kurikulumstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" id="course_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="materiModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kurikulum_id" class="form-label">Bagian<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kurikulum_id" name="kurikulum_id"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>
                    <div class="mb-3">
                        <label for="link_materi" class="form-label">Link Materi<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="link_materi" name="link_materi"
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
