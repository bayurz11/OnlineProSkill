<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Judul Artikel<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_title" name="title"
                            placeholder="Masukkan Judul Artikel Anda" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gambar">Banner Artikel<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar">
                        <img id="preview_edit" src="#" alt="Preview banner"
                            style="max-width: 100%; max-height: 200px; display: none;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="edit_category" class="js-example-basic-single form-select" name="kategori_id"
                            data-width="100%" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori_blog as $category)
                                @if ($category->status == 1)
                                    <option value="{{ $category->id }}">{{ $category->name_kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="conten" class="form-label">Isi Artikel<span class="text-danger">*</span></label>
                        <textarea id="conten" name="content" style="height: 400px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="edit_content_input" name="content" required>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#conten'))
                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                        const content_input = document.querySelector('#edit_content_input');
                                        content_input.value = editor.getData();
                                    });
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="edit_tag" name="tag">
                        <small class="text-secondary">Note : Isi Dengan Tags kursus yang relevan</small>
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="edit_date" name="date">
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
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/blog/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit-id').val(data.id);
                    $('#edit_title').val(data.title);
                    $('#edit_category').val(data.kategori_id);

                    if (data.gambar) {
                        $('#preview_edit').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#preview_edit').hide();
                    }

                    // Set the form action to the update route
                    $('#editForm').attr('action', `/blog/${data.id}`);

                    // Load content into CKEditor
                    ClassicEditor
                        .create(document.querySelector('#conten'))
                        .then(editor => {
                            editor.setData(data
                            .content); // Set the existing content into the editor

                            editor.model.document.on('change:data', () => {
                                const content_input = document.querySelector(
                                    '#edit_content_input');
                                content_input.value = editor.getData();
                            });
                        })
                        .catch(error => {
                            console.error('Error loading editor:', error);
                        });

                    // Set the existing tags
                    $('#edit_tag').val(data.tag);
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
