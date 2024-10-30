<!-- Modal Edit Kurikulum -->
<div class="modal fade" id="kurikulumModalEdit" tabindex="-1" aria-labelledby="kurikulumModalEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalEditModalLabel">Edit Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editKurikulumInstrukturForm" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" id="edit_course_id">
                    <input type="hidden" name="id" id="edit_kurikulum_id">

                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="saveKurikulumButton">Simpan</button>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('saveKurikulumButton').addEventListener('click', function() {
        var form = document.getElementById('editKurikulumInstrukturForm');
        var kurikulumId = document.getElementById('edit_kurikulum_id').value;

        // Set method dan action form
        form.setAttribute('action', `/instruktur_kurikulum/${kurikulumId}`);
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
</script>
