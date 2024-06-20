<!-- Edit Course Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="category" class="js-example-basic-single form-select" name="name_category"
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
                        <select id="subcategory" class="form-control" name="name_course" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Tingkat <span class="text-danger">*</span></label>
                        <select id="level" class="form-select" name="level" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="beginner">Pemula</option>
                            <option value="intermediate">Menengah</option>
                            <option value="advanced">Lanjutan</option>
                            <option value="all levels">Semua Tingkat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pimpinan" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
                        <textarea id="content" style="height: 800px; width: 200px; font-size: 18px;"></textarea>
                        <!-- Menggunakan <textarea> untuk CKEditor -->
                        <input type="hidden" id="content_input" name="content">
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
                        <label for="include" class="form-label">yang akan di pelajari <span
                                class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="discount" name="discount"
                            oninput="calculateDiscountedPrice()">
                    </div>
                    <div class="mb-3">
                        <label for="discountedPrice">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="discountedPrice" readonly>
                    </div>
                    <div class="mb-3">
                        <div>
                            <input type="checkbox" id="free" name="class" value="free"
                                onchange="togglePriceAndDiscount()">
                            <label for="free">Free</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar">
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

                    <div class="mb-3">
                        <label for="category" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="category" name="category">
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

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/categories/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#edit-id').val(data.id);
                    $('#name_course').val(data.name_course);
                    $('#category').val(data.category_id).trigger(
                        'change'); // Trigger change event to load subcategories

                    if (data.gambar) {
                        $('#preview').attr('src', `/public/uploads/${data.gambar}`).show();
                    } else {
                        $('#preview').hide();
                    }

                    // Set the form action to the update route
                    $('#editForm').attr('action', `/categories/${data.id}`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        // Display the uploaded image preview
        $('#gambar').change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Initialize Tagify
        var input = document.querySelector('input[name=category]');
        new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });

        // Add new include input
        $('#add-include').click(function() {
            const newInputGroup = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="include[]" >
                    <button class="btn btn-danger remove-include" type="button">-</button>
                </div>
            `;
            $('#include-container').append(newInputGroup);
        });

        // Remove include input
        $('#include-container').on('click', '.remove-include', function() {
            $(this).closest('.input-group').remove();
        });

        // Load subcategories based on selected category
        $('#category').change(function() {
            const categoryId = $(this).val();
            const subcategorySelect = $('#subcategory');
            subcategorySelect.prop('disabled', !categoryId);

            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.html('<option value="">Pilih Subkategori</option>');
                        data.forEach(subcategory => {
                            const option =
                                `<option value="${subcategory.id}">${subcategory.name}</option>`;
                            subcategorySelect.append(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                subcategorySelect.html('<option value="">Pilih Subkategori</option>');
            }
        });

        // Toggle price and discount inputs
        $('#free').change(function() {
            togglePriceAndDiscount();
        });

        function togglePriceAndDiscount() {
            var priceInput = $('#price');
            var discountInput = $('#discount');
            var freeCheckbox = $('#free');

            if (freeCheckbox.is(':checked')) {
                priceInput.val('').prop('disabled', true);
                discountInput.val('').prop('disabled', true);
            } else {
                priceInput.prop('disabled', false);
                discountInput.prop('disabled', false);
            }
        }

        // Calculate discounted price
        $('#discount, #price').on('input', function() {
            calculateDiscountedPrice();
        });

        function calculateDiscountedPrice() {
            var price = parseFloat($('#price').val());
            var discount = parseFloat($('#discount').val());
            var discountedPriceInput = $('#discountedPrice');

            if (!isNaN(price) && !isNaN(discount)) {
                var discountedPrice = price - (price * (discount / 100));
                discountedPriceInput.val(discountedPrice.toFixed());
            } else {
                discountedPriceInput.val('');
            }
        }
    });
</script>
