<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_kursus" class="form-label">Nama Kursus<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_kursus" name="nama_kursus"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="edit_category" class="form-select" name="kategori_id" data-width="100%">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categori as $category)
                                @if ($category->status == 1)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_subcategory" class="form-label">Subkategori<span
                                class="text-danger">*</span></label>
                        <select id="edit_subcategory" class="form-control" name="subkategori_id" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tingkat" class="form-label">Tingkat <span class="text-danger">*</span></label>
                        <select id="edit_tingkat" class="form-select" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Lanjutan">Lanjutan</option>
                            <option value="Semua Tingkat">Semua Tingkat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea id="edit_content" name="content" style="height: 400px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="edit_content_input" name="content">
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#edit_content'))
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
                        <label for="edit_include" class="form-label">Yang akan di pelajari <span
                                class="text-danger">*</span></label>
                        <div id="edit-include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edit_include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-edit-include">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price">
                    </div>

                    <div class="mb-3">
                        <label for="edit_discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="edit_discount" name="discount"
                            oninput="calculateEditDiscountedPrice()">
                    </div>

                    <div class="mb-3">
                        <label for="edit_discountedPrice">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="edit_discountedPrice" name="discountedPrice"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <div>
                            <input type="checkbox" id="edit_free" name="free" value="1"
                                onchange="toggleEditPriceAndDiscount()">
                            <label for="edit_free">Free</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="edit_gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar"
                            name="gambar">
                    </div>
                    <img id="edit_preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

                    <div class="mb-3">
                        <label for="edit_tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="edit_tag" name="tag">
                        <small class="text-secondary">Note : Isi Dengan Tags kursus yang relevan</small>
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
            fetch(`/Course/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#editCourseForm').attr('action', `/Course/${id}`);
                    $('#edit_nama_kursus').val(data.nama_kursus);
                    $('#edit_category').val(data.kategori_id);
                    $('#edit_subcategory').val(data.subkategori_id);
                    $('#edit_tingkat').val(data.tingkat);
                    $('#edit_content').val(data.content);
                    $('#edit_price').val(data.price);
                    $('#edit_discount').val(data.discount);
                    $('#edit_discountedPrice').val(data.discountedPrice);
                    $('#edit_free').prop('checked', data.free);

                    // Handle include fields
                    const includeContainer = $('#edit-include-container');
                    includeContainer.html('');
                    data.include.forEach(item => {
                        const inputGroup = $(`
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="include[]" value="${item}">
                                <button class="btn btn-danger remove-edit-include" type="button">-</button>
                            </div>
                        `);
                        includeContainer.append(inputGroup);
                    });

                    // Handle image preview
                    if (data.gambar) {
                        $('#edit_preview').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#edit_preview').hide();
                    }

                    // Trigger subcategory update
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
                })
                .catch(error => console.error('Error fetching course data:', error));
        });

        // Display the uploaded image preview
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

        // Include fields handling for edit form
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

        // Price and discount handling
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

    document.addEventListener("DOMContentLoaded", function() {
        $('#edit_tag').on('shown.bs.modal', function() {
            console.log("Modal is shown"); // Debugging
            var input = document.querySelector('input[name=tag]');
            if (input) {
                console.log("Tag input found"); // Debugging
                new Tagify(input, {
                    whitelist: [],
                    dropdown: {
                        enabled: 1,
                        maxItems: 100
                    }
                });
            } else {
                console.log("Tag input not found"); // Debugging
            }
        });
    });
</script>
