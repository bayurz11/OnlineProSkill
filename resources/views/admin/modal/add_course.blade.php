<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('storecategories') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
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
                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
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
                        <label for="include" class="form-label">Akan Didapatkan <span
                                class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="discount" name="discount"
                            oninput="calculateDiscountedPrice()">
                    </div>
                    <div class="mb-3">
                        <label for="discountedPrice">Harga Setelah Diskon</label>
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
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector('input[name=category]');

        new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });
    });
    $(document).ready(function() {
        $("#gambar").change(function() {
            readURL(this);
        });
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
    //include script
    document.addEventListener('DOMContentLoaded', function() {
        const addIncludeButton = document.getElementById('add-include');
        const includeContainer = document.getElementById('include-container');

        addIncludeButton.addEventListener('click', function() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
            <input type="text" class="form-control" name="include[]" >
            <button class="btn btn-danger remove-include" type="button">-</button>
        `;
            includeContainer.appendChild(newInputGroup);

            // Add event listener to the new remove button
            newInputGroup.querySelector('.remove-include').addEventListener('click', function() {
                newInputGroup.remove();
            });
        });

        // Event listener for initial remove button
        includeContainer.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-include')) {
                event.target.closest('.input-group').remove();
            }
        });
    });

    //select 
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const subcategorySelect = document.getElementById('subcategory');

        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            subcategorySelect.disabled = !categoryId;

            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
            }
        });
    });

    //price
    function togglePriceAndDiscount() {
        var priceInput = document.getElementById("price");
        var discountInput = document.getElementById("discount");
        var freeCheckbox = document.getElementById("free");

        if (freeCheckbox.checked) {
            priceInput.value = ""; // Clear the price field
            discountInput.value = ""; // Clear the discount field
            priceInput.disabled = true; // Disable the price input
            discountInput.disabled = true; // Disable the discount input
        } else {
            priceInput.disabled = false; // Enable the price input
            discountInput.disabled = false; // Enable the discount input
        }
    }
    //diskon
    function calculateDiscountedPrice() {
        var priceInput = document.getElementById("price");
        var discountInput = document.getElementById("discount");
        var discountedPriceInput = document.getElementById("discountedPrice");

        // Parse the values as numbers (floats)
        var price = parseFloat(priceInput.value);
        var discount = parseFloat(discountInput.value);

        // Calculate the discounted price
        if (!isNaN(price) && !isNaN(discount)) {
            var discountedPrice = price - (price * (discount / 100));
            discountedPriceInput.value = discountedPrice.toFixed(2); // Display up to 2 decimal places
        } else {
            discountedPriceInput.value = ""; // Clear the discounted price if inputs are not valid numbers
        }
    }
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const subcategorySelect = document.getElementById('subcategory');

        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            subcategorySelect.disabled = !categoryId;

            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
            }
        });
    });
</script> --}}
