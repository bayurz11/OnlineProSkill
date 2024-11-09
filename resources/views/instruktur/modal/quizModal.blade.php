<div class="modal fade" id="QuizModal" tabindex="-1" aria-labelledby="QuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="createKurikulumForm" action="{{ route('instruktur_section.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="QuizModalLabel">Tambah Quiz Baru</h5>
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
                        <label for="link" class="form-label">Pilih Course</label>
                        <select class="form-control" id="link" name="link">
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kursus }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Link Materi</label>
                        <input type="text" class="form-control" id="link" name="link"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const QuizModal = document.getElementById('QuizModal');
        const courseIdInput = document.getElementById('kurikulum_id');

        if (QuizModal && courseIdInput) {
            // Saat modal ditampilkan
            QuizModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Mendapatkan tombol yang memicu modal
                const courseId = button.getAttribute('data-id'); // Mendapatkan nilai data-id

                if (courseId) {
                    console.log('Course ID ditemukan dari data-id:', courseId); // Debugging
                    courseIdInput.value = courseId; // Set nilai input tersembunyi
                } else {
                    console.warn('Course ID tidak ditemukan!'); // Debug jika ID tidak ditemukan
                }
            });

            // Saat modal ditutup
            QuizModal.addEventListener('hide.bs.modal', function() {
                console.log('Modal ditutup, mengatur ulang formulir.');
                document.getElementById('createKurikulumForm').reset(); // Mengatur ulang formulir
            });
        }
    });
</script>
