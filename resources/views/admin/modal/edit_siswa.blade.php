<!-- Edit Modal -->
<div class="modal fade" id="editModalsiswa" tabindex="-1" aria-labelledby="editModalsiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <<form id="editModalsiswa" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalsiswaLabel">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editname" name="name">
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
        const editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const userId = this.dataset.id;

                // Ambil data siswa dari server menggunakan AJAX
                fetch(`/siswa/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Isi data ke dalam form modal
                            document.getElementById('name').value = data.siswa.name;
                            document.getElementById('edit_durasi').value = data.siswa
                                .durasi;
                            document.getElementById('edit_sertifikat').value = data.siswa
                                .sertifikat;
                            document.getElementById('edit_kuota').value = data.siswa.kuota;
                            document.getElementById('edit_subcategory').value = data.siswa
                                .subkategori_id;
                            document.getElementById('edit_tingkat').value = data.siswa
                                .tingkat;
                            document.getElementById('edit_content').value = data.siswa
                                .content;
                            document.getElementById('edit_price').value = data.siswa.price;

                            // Set image preview
                            const preview = document.getElementById('edit_preview');
                            preview.src = data.siswa.gambar ? asset('public/uploads/' + data
                                .siswa.gambar) : '#';
                            preview.style.display = 'block';

                            // Tampilkan modal
                            var myModal = new bootstrap.Modal(document.getElementById(
                                'editModalsiswa'));
                            myModal.show();
                        } else {
                            alert('Gagal mengambil data siswa');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan');
                    });
            });
        });
    });
</script>
