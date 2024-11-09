<div class="modal fade" id="QuizModal" tabindex="-1" aria-labelledby="QuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="createKurikulumForm" action="{{ route('instruktur_quiz.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="QuizModalLabel">Tambah Quiz Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field for kurikulum_id -->
                    <input type="hidden" name="id_instruktur" id="id_instruktur" value="{{ Auth::user()->id }}">


                    <div class="mb-3">
                        <label for="judul_tugas" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul_tugas" name="judul_tugas"
                            placeholder="Masukkan Judul Quiz Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Pilih Course</label>
                        <select class="form-control" id="course_id" name="course_id">
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                @php
                                    // Mengecek apakah course_id ada di model Kurikulum
                                    $kurikulumExists = \App\Models\Kurikulum::where('course_id', $kelas->id)->exists();

                                @endphp
                                @if ($kurikulumExists)
                                    <option value="{{ $kelas->id }}">
                                        {{ $kelas->nama_kursus }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="me-2" style="flex: 1;">
                            <label for="jam_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                placeholder="Pilih waktu mulai">
                        </div>
                        <div style="flex: 1;">
                            <label for="jam_akhir" class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control" id="jam_akhir" name="jam_akhir"
                                placeholder="Pilih waktu selesai">
                        </div>
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
