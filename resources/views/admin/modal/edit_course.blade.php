<!-- Include your modal structure -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kursus" class="form-label">Nama Kursus<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_kursus" name="nama_kursus"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="category" class="js-example-basic-single form-select" name="kategori_id"
                            data-width="100%">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categori as $category)
                                @if ($category->status == 1)
                                    <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Subkategori<span
                                class="text-danger">*</span></label>
                        <select id="edit_subcategory" class="form-control" name="subkategori_id" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tingkat" class="form-label">Tingkat <span class="text-danger">*</span></label>
                        <select id="edit_tingkat" class="form-select" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Lanjutan">Lanjutan</option>
                            <option value="Semua Tingkat">Semua Tingkat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea id="edit_content" style="height: 800px; width: 200px; font-size: 18px;"></textarea>
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
                        <label for="include" class="form-label">Yang Akan Dipelajari <span
                                class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edit_include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="edit_discount" name="discount">
                    </div>
                    <div class="mb-3">
                        <label for="discountedPrice">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="edit_discountedPrice" name="discountedPrice"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <div>
                            <input type="checkbox" id="edit_free" name="free" value="1">
                            <label for="free">Free</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar"
                            name="gambar">
                    </div>
                    <img id="edit_preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">
                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
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
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/Course/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit-id').val(data.id);
                    $('#edit_nama_kursus').val(data.nama_kursus);
                    $('#category').val(data.kategori_id).trigger('change');
                    $('#edit_subcategory').val(data.subkategori_id);
                    $('#edit_tingkat').val(data.tingkat);
                    $('#edit_content').val(data.content);
                    $('#edit_content_input').val(data.content);
                    $('#edit_price').val(data.price);
                    $('#edit_discount').val(data.discount);
                    $('#edit_discountedPrice').val(data.discountedPrice);
                    $('#edit_tag').val(data.tag);

                    if (data.gambar) {
                        $('#edit_preview').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#edit_preview').hide();
                    }

                    // Set the form action to the update route
                    $('#editForm').attr('action', `/Course/${data.id}`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
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
                    $('#edit_preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Calculate discounted price
        function calculateDiscountedPrice() {
            let price = parseFloat($('#edit_price').val());
            let discount = parseFloat($('#edit_discount').val());
            if (!isNaN(price) && !isNaN(discount)) {
                let discountedPrice = price - (price * discount / 100);
                $('#edit_discountedPrice').val(discountedPrice);
            } else {
                $('#edit_discountedPrice').val(price);
            }
        }

        $('#edit_discount').on('input', calculateDiscountedPrice);
        $('#edit_price').on('input', calculateDiscountedPrice);

        // Toggle price and discount fields if the course is free
        $('#edit_free').change(function() {
            if ($(this).is(':checked')) {
                $('#edit_price').val(0).attr('readonly', true);
                $('#edit_discount').val(0).attr('readonly', true);
                $('#edit_discountedPrice').val(0);
            } else {
                $('#edit_price').attr('readonly', false);
                $('#edit_discount').attr('readonly', false);
            }
        });

        // Initialize Tagify
        var input = document.querySelector('input[name=tag]');
        new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });

        // Handle include fields
        const addIncludeButton = document.getElementById('add-include');
        const includeContainer = document.getElementById('include-container');

        addIncludeButton.addEventListener('click', function() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
                <input type="text" class="form-control" name="include[]">
                <button class="btn btn-danger remove-include" type="button">-</button>
            `;
            includeContainer.appendChild(newInputGroup);
        });

        includeContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-include')) {
                event.target.closest('.input-group').remove();
            }
        });

        // Category and subcategory change logic
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            $('#edit_subcategory').prop('disabled', !categoryId);
            $('#edit_subcategory').empty().append('<option value="">Pilih Subkategori</option>');
            if (categoryId) {
                $.ajax({
                    url: `/getSubcategories/${categoryId}`,
                    type: 'GET',
                    success: function(subcategories) {
                        $.each(subcategories, function(key, subcategory) {
                            $('#edit_subcategory').append(
                                `<option value="${subcategory.id}">${subcategory.name_subcategory}</option>`
                            );
                        });
                    }
                });
            }
        });
    });
</script>
