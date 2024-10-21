<!-- Modal -->
<div class="modal fade" id="kurikulumModal" tabindex="-1" aria-labelledby="kurikulumModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalModalLabel">Create a New Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data"
                    id="createCourseForm">
                    @csrf


                    <div class="mb-3">
                        <label for="nama_kursus" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kursus" name="nama_kursus"
                            placeholder="Masukkan Nama Kursus Anda" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" form="createCourseForm">Simpan</button>
            </div>
        </div>
    </div>
</div>
