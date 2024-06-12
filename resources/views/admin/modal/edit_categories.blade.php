<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name_category" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name_category_edit" name="name_category"
                            placeholder="Masukkan Nama Kategori Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gambar">Icon Kategori</label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar">
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

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
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/categories/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit-id').val(data.id);
                    $('#name_category_edit').val(data.name_category);

                    if (data.gambar) {
                        $('#preview_edit').attr('src', `/path/to/images/${data.gambar}`).show();
                    } else {
                        $('#preview_edit').hide();
                    }

                    // Set the form action to the update route
                    $('#editForm').attr('action', `/categories/${data.id}`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        // Display the uploaded image preview
        $('#gambar_edit').change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview_edit').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    });
</script>
