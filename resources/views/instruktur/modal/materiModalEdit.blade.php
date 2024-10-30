<!-- Modal untuk Edit Kurikulum -->
<div class="modal fade" id="sectionModalEdit" tabindex="-1" aria-labelledby="sectionModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSectionForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="kurikulum_id" name="kurikulum_id">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_title" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
                    </div>
                    <div class="mb-3">
                        <label for="linkedit" class="form-label">Link Materi</label>
                        <input type="text" class="form-control" id="linkedit" name="link"
                            placeholder="Masukkan link materi Anda">
                    </div>
                    <div class="mb-3">
                        <label for="durationedit" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="durationedit" name="duration"
                            placeholder="00:00:00">
                    </div>
                    <div class="mb-3">
                        <label for="fileedit" class="form-label">Upload Materi</label>
                        <input type="file" class="form-control" id="fileedit" name="file">
                    </div>
                    <div class="mb-3" id="fileDisplay">
                        <!-- Informasi file akan ditampilkan di sini -->
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
    $(document).ready(function() {
        $('#sectionModalEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var sectionId = button.data('id'); // Ambil data-id dari tombol
            console.log('section ID:', sectionId); // Debugging line

            // AJAX request untuk mengambil data section
            $.ajax({
                url: '/instruktur_section/' + sectionId + '/edit',
                method: 'GET',
                success: function(response) {
                    console.log(response); // Debugging line
                    if (response.kurikulum_id) {
                        $('#kurikulum_id').val(response
                            .kurikulum_id); // Set nilai kurikulum_id di dalam modal
                    } else {
                        console.log('kurikulum_id is missing in response');
                    }
                    $('#edit_title').val(response
                        .title); // Set nilai judul section di dalam modal
                    $('#link_edit').val(response
                        .link); // Set nilai link section di dalam modal
                    $('#duration_edit').val(response
                        .duration); // Set nilai link section di dalam modal

                    // Handle file display or download link
                    if (response.file_path) {
                        var fileName = response.file_name ||
                            'File'; // Nama file jika tersedia atau default 'File'
                        var fileDownloadUrl = '/public/' + response
                            .file_path; // URL untuk mengunduh file

                        // Tampilkan informasi file atau buat tautan unduh
                        var fileDisplayHtml = '<p>File: <a href="' + fileDownloadUrl +
                            '" target="_blank">' + fileName + '</a></p>';
                        $('#fileDisplay').html(
                            fileDisplayHtml); // Ganti #fileDisplay dengan ID elemen Anda
                    } else {
                        $('#fileDisplay').html(
                            '<p>No file uploaded.</p>'
                        ); // Kasus di mana tidak ada file yang diunggah
                    }

                    // Set action form dengan id yang benar
                    $('#edit_SectionForm').attr('action', '/instruktur_section/' +
                        sectionId);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
    document.getElementById('duration').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9:]/g, ''); // Hanya izinkan angka dan tanda titik dua
        let parts = value.split(':').map(Number); // Pisahkan berdasarkan tanda titik dua dan ubah menjadi angka

        // Menangani format jam:menit:detik
        if (parts.length === 1 && parts[0] > 59) {
            parts[1] = parts[0] % 60;
            parts[0] = Math.floor(parts[0] / 60);
        } else if (parts.length === 2 && parts[1] > 59) {
            parts[2] = parts[1] % 60;
            parts[1] = Math.floor(parts[1] / 60);
        }

        // Format kembali menjadi string dengan leading zero jika perlu
        value = parts.map(part => part.toString().padStart(2, '0')).join(':');

        // Set kembali nilai input field
        e.target.value = value;
    });
</script>
