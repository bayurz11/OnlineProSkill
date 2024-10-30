<div class="modal fade" id="sectionModalEdit" tabindex="-1" aria-labelledby="sectionModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="sectionModalEditForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModalEditLabel">Edit Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field for section_id -->
                    <input type="hidden" name="section_id" id="section_id">

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_title" name="title"
                            placeholder="Masukkan Judul Materi Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Materi</label>
                        <input type="text" class="form-control" id="edit_link" name="link"
                            placeholder="Masukkan link materi Anda">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="edit_duration" name="duration"
                            placeholder="00:00:00">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Materi</label>
                        <input type="file" class="form-control" id="edit_file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary" id="saveSectionButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sectionModalEdit = document.getElementById('sectionModalEdit');

        sectionModalEdit.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const sectionId = button.getAttribute('data-id');

            // Fetch data dari controller untuk modal
            fetch(`/instruktur_section/${sectionId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('section_id').value = data.id;
                    document.getElementById('edit_title').value = data.title;
                    document.getElementById('edit_link').value = data.link || '';
                    document.getElementById('edit_duration').value = data.duration || '';
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('saveSectionButton').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('sectionModalEditForm');
            var sectionId = document.getElementById('section_id').value;

            // Set method dan action form
            form.setAttribute('action', `/instruktur_section/${sectionId}`);
            form.setAttribute('method', 'POST');

            // Tambahkan input hidden untuk method PUT
            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            // Kirim form
            form.submit();
        });
    });
</script>
