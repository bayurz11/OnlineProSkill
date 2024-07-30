<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editEventForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Event<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Masukkan Nama Event">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_gambar">Banner Event<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar" name="gambar">
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">
                    <div class="mb-3">
                        <label for="edit_tgl" class="form-label">Tanggal Dilaksanakan<span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_tgl" name="tgl">
                    </div>
                    <div class="mb-3">
                        <label for="edit_lokasi" class="form-label">Lokasi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_lokasi" name="lokasi">
                    </div>
                    <div class="mb-3">
                        <label for="edit_link_maps" class="form-label">Link Lokasi<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_link_maps" name="link_maps">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/event/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit_name').val(data.name);
                    $('#edit_tgl').val(data.tgl);
                    $('#edit_lokasi').val(data.lokasi);
                    $('#edit_link_maps').val(data.link_maps);

                    // Update image preview
                    if (data.gambar) {
                        $('#preview').attr('src', `/uploads/${data.gambar}`).show();
                    } else {
                        $('#preview').hide();
                    }

                    // Set the form action to the update route
                    $('#editEventForm').attr('action', `/event/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Gagal mengambil data event');
                });
        });

        // Display the uploaded image preview
        $('#edit_gambar').change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#preview').hide();
            }
        }
    });
</script>
