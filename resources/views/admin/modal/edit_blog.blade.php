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
                        <label for="title" class="form-label">Judul Artikel<span class="text-danger">*</span></label>
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
                        <label for="content" class="form-label">Isi Artikel<span class="text-danger">*</span></label>
                        <textarea id="content" name="content" style="height: 400px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="content_input" name="content" required>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#content'))
                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                        const content_input = document.querySelector('#content_input');
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
    function editBlog(id) {
        $.ajax({
            url: '/blog/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#editModalForm').attr('action', '/blog/' + id);
                $('#edit_title').val(data.title);
                $('#edit_category').val(data.kategori_id).trigger('change');
                $('#edit_content').val(data.content);
                $('#edit_content_input').val(data.content);
                $('#edit_tag').val(data.tag);
                $('#edit_date').val(data.date);

                if (data.gambar) {
                    $('#preview_edit').attr('src', `/public/uploads/${data.gambar}`).show();
                } else {
                    $('#preview_edit').hide();
                }

                $('#editModal').modal('show');
            },
            error: function(xhr) {
                alert('Blog not found');
            }
        });
    }
</script>
