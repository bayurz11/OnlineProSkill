<div class="modal fade" id="editSertifikat2Modal" tabindex="-1" aria-labelledby="editSertifikat2ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSertifikatForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSertifikat2ModalLabel">Edit Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="edit_sertifikat_id" class="form-label">ID Sertifikat<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_sertifikat_id" name="sertifikat_id"
                            placeholder="Masukkan ID Sertifikat">
                    </div>

                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_keterangan" name="keterangan"
                            placeholder="Masukkan Keterangan">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="edit_category" class="form-select" name="kategori_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($classroom as $class)
                                @if ($class->status == 1)
                                    <option value="{{ $class->id }}">{{ $class->nama_kursus }}</option>
                                @endif
                            @endforeach
                        </select>
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
            fetch(`/sertifikat/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit_name').val(data.name);
                    $('#edit_sertifikat_id').val(data.sertifikat_id);
                    $('#edit_keterangan').val(data.keterangan);
                    $('#edit_category').val(data.kategori_id);

                    const categoryId = data.kategori_id;
                    const subcategorySelect = $('#edit_subcategory');
                    subcategorySelect.prop('disabled', !categoryId);
                    if (categoryId) {
                        fetch(`/get-subcategories/${categoryId}`)
                            .then(response => response.json())
                            .then(subcategories => {
                                subcategorySelect.html(
                                    '<option value="">Pilih Subkategori</option>');
                                subcategories.forEach(subcategory => {
                                    if (subcategory.status == 1) {
                                        const option = $('<option></option>')
                                            .attr('value', subcategory.id)
                                            .text(subcategory.name);
                                        if (subcategory.id == data.subkategori_id) {
                                            option.prop('selected', true);
                                        }
                                        subcategorySelect.append(option);
                                    }
                                });
                            })
                            .catch(error => console.error('Error fetching subcategories:', error));
                    } else {
                        subcategorySelect.html('<option value="">Pilih Subkategori</option>');
                    }
                    // Update image preview
                    if (data.gambar) {
                        $('#preview_edit').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#preview_edit').hide();
                    }

                    // Set the form action to the update route
                    $('#editSertifikatForm').attr('action', `/sertifikat/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Gagal mengambil data sertifikat');
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
                    $('#preview_edit').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#preview_edit').hide();
            }
        }
    });
</script>
