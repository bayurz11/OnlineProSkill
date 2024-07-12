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

                    <input type="hidden" class="form-control" id="kurikulum_id" name="kurikulum_id"
                        placeholder="Masukkan judul Kurikulum Anda">

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
                const kurikulumModal = document.getElementById('kurikulumModal');
                kurikulumModal.addEventListener('show.bs.modal', function(event) {
                    const courseId = localStorage.getItem('selectedCourseId');
                    if (courseId) {
                        console.log('Course ID found in localStorage:', courseId);
                        document.getElementById('course_id').value = courseId;
                    }
                });

                kurikulumModal.addEventListener('hide.bs.modal', function(event) {
                    console.log('Modal closed, resetting form.');
                    document.getElementById('kurikulumForm').reset();
                });
                $(document).ready(function() {
                    $('#materiModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget); // Tombol yang membuka modal
                        var kurikulumId = button.data('id'); // Ambil data-id dari tombol
                        console.log('Kurikulum ID:', kurikulumId); // Debugging line

                        var modal = $(this);
                        modal.find('.modal-body #kurikulum_id').val(kurikulumId);
                    });
                });
</script>
