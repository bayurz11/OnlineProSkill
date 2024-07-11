<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="kurikulumForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="course_id" id="course_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalEditLabel">Edit Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edittitle" name="title"
                            placeholder="Masukkan judul Kurikulum Anda">
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
        const editors = {};

        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/kurikulum/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    $('#kurikulumForm').attr('action', `/kurikulum/${id}/edit`);
                    $('#course_id').val(id);
                    $('#edittitle').val(data.title);

                    if (editors[id]) {
                        editors[id].destroy().then(() => {
                            delete editors[id];
                            createEditor(id, data.content);
                        });
                    } else {
                        createEditor(id, data.content);
                    }
                })
                .catch(error => console.error('Error fetching class data:', error));
        });

        function createEditor(id, content) {
            ClassicEditor.create(document.querySelector('#edit_content'))
                .then(editor => {
                    editors[id] = editor;
                    editor.setData(content);
                    editor.model.document.on('change:data', () => {
                        const content_input = document.querySelector('#edit_content_input');
                        content_input.value = editor.getData();
                    });
                })
                .catch(error => console.error(error));
        }

        $('#kurikulumForm').on('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Kurikulum berhasil diperbarui');
                    $('#exampleModalEdit').modal('hide');
                    // Lakukan tindakan lain setelah berhasil diperbarui
                },
                error: function(response) {
                    alert('Terjadi kesalahan saat memperbarui kurikulum');
                }
            });
        });
    });
</script>
