<!-- Modal untuk Edit Kurikulum -->
<div class="modal fade" id="kurikulumModal" tabindex="-1" aria-labelledby="kurikulumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="kurikulumForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="course_id" id="course_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="kurikulumModalLabel">Edit Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
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

<!-- Script untuk mengambil ID kursus dari localStorage dan mereset form -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kurikulumModal = document.getElementById('kurikulumModal');

        kurikulumModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const kurikulumId = button.getAttribute('data-id');
            localStorage.setItem('selectedCourseId', kurikulumId);
            const courseId = localStorage.getItem('selectedCourseId');
            if (courseId) {
                console.log('Course ID found in localStorage:', courseId);
                document.getElementById('course_id').value = courseId;

                $(document).ready(function() {
                    $('#exampleModalEdit').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var kurikulumId = button.data('id');
                        console.log('Kurikulum ID:', kurikulumId); // Debugging line
                        $('#course_id').val(
                        kurikulumId); // Pastikan ada elemen dengan id 'course_id'

                        $.ajax({
                            url: '/kurikulum/' + kurikulumId + '/edit',
                            method: 'GET',
                            success: function(response) {
                                $('#edittitle').val(response
                                    .title
                                    ); // Pastikan ada elemen dengan id 'edittitle'
                            },
                            error: function(xhr) {
                                console.log('Error:', xhr);
                            }
                        });
                    });
                });
            }
        });

        kurikulumModal.addEventListener('hide.bs.modal', function(event) {
            console.log('Modal closed, resetting form.');
            document.getElementById('kurikulumForm').reset();
            localStorage.removeItem('selectedCourseId');
        });
    });
</script>
