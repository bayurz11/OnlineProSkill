<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

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
                    </div>

                    <div class="mb-3">
                        <label for="edit_tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="edit_tag" name="tag">
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
    let editorInstance;

    // Initialize CKEditor only once when the page loads
    ClassicEditor
        .create(document.querySelector('#conten'))
        .then(editor => {
            editorInstance = editor;

            editor.model.document.on('change:data', () => {
                const content_input = document.querySelector('#edit_content_input');
                content_input.value = editor.getData();
            });
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });

    $(document).ready(function() {
        // Initialize Tagify on the tags input
        var input = document.querySelector('input[name=tag]');
        var tagify = new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });

        // Handle the edit button click event
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/blog/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Set other fields in the modal
                    $('#edit-id').val(data.id);
                    $('#edit_title').val(data.title);
                    $('#edit_category').val(data.kategori_id);
                    $('#edit_date').val(data.date);

                    // Handle image preview
                    if (data.gambar) {
                        $('#preview_edit').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#preview_edit').hide();
                    }

                    // Set the form action to the update route
                    $('#editModalForm').attr('action', `/blog/${data.id}`);

                    // Set the existing content into the CKEditor
                    editorInstance.setData(data.content);

                    // Parse and set tags in Tagify
                    try {
                        const tags = JSON.parse(data
                        .tag); // Parse tag data if it's in string format
                        tagify.removeAllTags(); // Clear existing tags
                        tagify.addTags(tags.map(tag => tag
                        .value)); // Map the tags to their values and add them
                    } catch (error) {
                        console.error('Error parsing tags:', error);
                    }
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
