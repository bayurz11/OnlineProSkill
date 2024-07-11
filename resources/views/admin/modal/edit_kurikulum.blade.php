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

                    $('#editCourseForm').attr('action', `/kurikulum/${id}`);
                    $('#edittitle').val(data.title);
                    $('#edit_durasi').val(data.durasi);
                    $('#edit_sertifikat').val(data.sertifikat);
                    $('#edit_kuota').val(data.kuota);
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

                    $('#edit_tingkat').val(data.tingkat);

                    if (editors[id]) {
                        editors[id].destroy().then(() => {
                            delete editors[id];
                            createEditor(id, data.content);
                        });
                    } else {
                        createEditor(id, data.content);
                    }

                    $('#edit_price').val(data.price);
                    $('#edit_discount').val(data.discount);
                    $('#edit_discountedPrice').val(data.discountedPrice);

                    if (data.gambar) {
                        $('#edit_preview').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#edit_preview').hide();
                    }

                    let tagValue = '';
                    try {
                        const parsedTag = JSON.parse(data.tag);

                        if (Array.isArray(parsedTag) && parsedTag.length > 0) {
                            tagValue = parsedTag[0].value;
                        } else if (typeof parsedTag === 'object' && parsedTag !== null) {
                            tagValue = parsedTag.value;
                        } else if (typeof parsedTag === 'string') {
                            tagValue = parsedTag;
                        }
                    } catch (e) {
                        if (typeof data.tag === 'string') {
                            tagValue = data.tag;
                        }
                    }

                    $('#edit_tag').val(tagValue);

                    const includeContainer = $('#edit-include-container');
                    includeContainer.html('');

                    try {
                        const includes = JSON.parse(data.include);

                        if (Array.isArray(includes)) {
                            includes.forEach(item => {
                                const inputGroup = $(`
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="include[]" value="${item}">
                                <button class="btn btn-danger remove-edit-include" type="button">-</button>
                            </div>
                        `);
                                includeContainer.append(inputGroup);
                            });
                        } else {
                            console.error('Parsed include is not an array:', includes);
                        }
                    } catch (e) {
                        console.error('Error parsing include:', e, data.include);
                    }

                    toggleEditPriceAndDiscount();
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

        $('#edit_gambar').change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#add-edit-include').on('click', function() {
            const inputGroup = $(`
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="include[]">
            <button class="btn btn-danger remove-edit-include" type="button">-</button>
        </div>
    `);
            $('#edit-include-container').append(inputGroup);
        });

        $(document).on('click', '.remove-edit-include', function() {
            $(this).closest('.input-group').remove();
        });

        function calculateEditDiscountedPrice() {
            const price = parseFloat($('#edit_price').val());
            const discount = parseFloat($('#edit_discount').val());
            if (!isNaN(price) && !isNaN(discount)) {
                const discountedPrice = price - (price * (discount / 100));
                $('#edit_discountedPrice').val(discountedPrice.toFixed(2));
            }
        }

        $('#edit_discount').on('input', calculateEditDiscountedPrice);

        function toggleEditPriceAndDiscount() {
            const isFree = $('#edit_free').is(':checked');
            $('#edit_price, #edit_discount, #edit_discountedPrice').prop('disabled', isFree);
            if (isFree) {
                $('#edit_price, #edit_discount, #edit_discountedPrice').val('');
            }
        }

        $('#edit_free').on('change', toggleEditPriceAndDiscount);
    });
</script>
