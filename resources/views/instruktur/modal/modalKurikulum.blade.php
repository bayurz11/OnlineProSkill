<div class="modal fade" id="kurikulumModal" tabindex="-1" aria-labelledby="kurikulumModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalModalLabel">Buat Kurikulum Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('instruktur_kurikulum.store') }}" method="POST" id="createKurikulumForm">
                    @csrf
                    <!-- Hidden field for course_id -->
                    <input type="hidden" name="course_id" id="course_id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan Judul Kurikulum Anda" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" form="createKurikulumForm">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kurikulumModal = document.getElementById('kurikulumModal');
        kurikulumModal.addEventListener('show.bs.modal', function(event) {
            // Mendapatkan tombol yang memicu modal
            const button = event.relatedTarget;
            // Mengambil nilai dari atribut data-id
            const courseId = button.getAttribute('data-id');
            if (courseId) {
                console.log('Course ID ditemukan dari data-id:', courseId);
                document.getElementById('course_id').value = courseId;
            }
        });

        kurikulumModal.addEventListener('hide.bs.modal', function(event) {
            console.log('Modal ditutup, mengatur ulang formulir.');
            document.getElementById('createKurikulumForm').reset();
        });
    });
</script>
