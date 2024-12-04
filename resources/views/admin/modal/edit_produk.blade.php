<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" hidden>
                        {{-- <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="edit_online"
                                value="online">
                            <label class="form-check-label" for="edit_online">Online Course</label>
                        </div> --}}
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="edit_produk"
                                value="produk">
                            <label class="form-check-label" for="edit_produk">Offline Class</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kursus" class="form-label">Nama Kursus<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_kursus" name="nama_kursus"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="edit_category" class="form-select" name="kategori_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categori as $category)
                                @if ($category->status == 1)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea id="edit_content" name="content" style="height: 400px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="edit_content_input" name="content">
                    </div>

                    {{-- <div class="mb-3">
                        <label for="edit_include" class="form-label">Yang akan dipelajari <span
                                class="text-danger">*</span></label>
                        <div id="edit-include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edit_include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-edit-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_perstaratan" class="form-label">Perstaratan <span
                                class="text-danger">*</span></label>
                        <div id="edit-perstaratan-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edit_perstaratan"
                                    name="perstaratan[]">
                                <button class="btn btn-success" type="button" id="add-edit-perstaratan">+</button>
                            </div>
                        </div>
                    </div> --}}

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit_discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="edit_discount" name="discount"
                            oninput="calculateEditDiscountedPrice()">
                    </div>
                    <div class="mb-3">
                        <label for="edit_discountedPrice" class="form-label">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="edit_discountedPrice" name="discountedPrice"
                            readonly>
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label" for="edit_gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar" name="gambar">
                    </div>
                    <img id="edit_preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">
                    <div class="mb-3">
                        <label for="edit_tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="edit_tag" name="tag">
                        <small class="text-secondary">Note: Isi Dengan Tags kursus yang relevan</small>
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
            fetch(`/produk/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    $('#editCourseForm').attr('action', `/produk/${id}`);
                    $('#edit_nama_kursus').val(data.nama_kursus);
                    $('#edit_durasi').val(data.durasi);
                    $('#edit_sertifikat').val(data.sertifikat);
                    $('#edit_kuota').val(data.kuota);
                    $('#edit_category').val(data.kategori_id);

                    if (data.course_type === 'online') {
                        $('#edit_online').prop('checked', true);
                    } else if (data.course_type === 'produk') {
                        $('#edit_produk').prop('checked', true);
                    }

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
                    const perstaratanContainer = $('#edit-perstaratan-container');
                    perstaratanContainer.html('');

                    try {
                        const perstaratans = JSON.parse(data.perstaratan);

                        if (Array.isArray(perstaratans)) {
                            perstaratans.forEach(item => {
                                const inputGroup = $(`
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="perstaratan[]" value="${item}">
                                    <button class="btn btn-danger remove-edit-perstaratan" type="button">-</button>
                                </div>
                            `);
                                perstaratanContainer.append(inputGroup);
                            });
                        } else {
                            console.error('Parsed perstaratan is not an array:', perstaratans);
                        }
                    } catch (e) {
                        console.error('Error parsing perstaratan:', e, data.perstaratan);
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
        $('#add-edit-perstaratan').on('click', function() {
            const inputGroup = $(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="perstaratan[]">
                <button class="btn btn-danger remove-edit-perstaratan" type="button">-</button>
            </div>
        `);
            $('#edit-perstaratan-container').append(inputGroup);
        });

        $(document).on('click', '.remove-edit-perstaratan', function() {
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
{{-- <script>
    $(document).ready(function() {
        const editors = {};

        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/class/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    $('#editCourseForm').attr('action', `/class/${id}`);
                    $('#edit_nama_kursus').val(data.nama_kursus);
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
</script> --}}
