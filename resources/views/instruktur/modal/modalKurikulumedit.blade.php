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
                <form id="editKurikulumInstrukturForm">
                    @csrf
                    @method('PUT')
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
    document.addEventListener('DOMContentLoaded', function() {
        const kurikulumModalEdit = document.getElementById('kurikulumModalEdit');

        kurikulumModalEdit.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const kurikulumId = button.getAttribute('data-id');

            fetch(`/instruktur_kurikulum/${kurikulumId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_kurikulum_id').value = data.id;
                    document.getElementById('edittitle').value = data.title;
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('saveKurikulumButton').addEventListener('click', function(event) {
            event.preventDefault();

            const kurikulumId = document.getElementById('edit_kurikulum_id').value;
            const title = document.getElementById('edittitle').value;

            fetch(`/instruktur_kurikulum/${kurikulumId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        title: title
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Kurikulum berhasil diperbarui');
                        const modal = bootstrap.Modal.getInstance(kurikulumModalEdit);
                        modal.hide(); // Tutup modal setelah berhasil

                        // Tunggu beberapa milidetik sebelum refresh
                        setTimeout(() => {
                            location.reload(); // Refresh halaman setelah modal ditutup
                        }, 500); // 500ms delay
                    } else {
                        alert('Gagal memperbarui kurikulum');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
