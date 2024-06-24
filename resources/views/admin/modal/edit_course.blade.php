<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <select id="edit_category" class="js-example-basic-single form-select" name="kategori_id"
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
                        <label for="edit_include" class="form-label">yang akan di pelajari <span
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
    // Tags initialization
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector('input[name=tag]');
        new Tagify(input, {
            whitelist: [],
            dropdown: {
                enabled: 1,
                maxItems: 100
            }
        });
    });

    // Gambar preview
    $(document).ready(function() {
        $("#edit_gambar").change(function() {
            readURLEdit(this);
        });
    });

    function readURLEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit_preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Include fields handling
    document.addEventListener('DOMContentLoaded', function() {
        const addEditIncludeButton = document.getElementById('add-edit-include');
        const editIncludeContainer = document.getElementById('edit-include-container');

        addEditIncludeButton.addEventListener('click', function() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
                <input type="text" class="form-control" name="include[]" >
                <button class="btn btn-danger remove-edit-include" type="button">-</button>
            `;
            editIncludeContainer.appendChild(newInputGroup);

            newInputGroup.querySelector('.remove-edit-include').addEventListener('click', function() {
                newInputGroup.remove();
            });
        });

        editIncludeContainer.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-edit-include')) {
                event.target.closest('.input-group').remove();
            }
        });
    });

    // Kategori dan Subkategori handling
    document.addEventListener('DOMContentLoaded', function() {
        const editCategorySelect = document.getElementById('edit_category');
        const editSubcategorySelect = document.getElementById('edit_subcategory');

        editCategorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            editSubcategorySelect.disabled = !categoryId;
            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        editSubcategorySelect.innerHTML =
                            '<option value="">Pilih Subkategori</option>';
                        data.forEach(subcategory => {
                            if (subcategory.status == 1) {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.name;
                                editSubcategorySelect.appendChild(option);
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                editSubcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
            }
        });
    });

    // Price and discount handling
    function toggleEditPriceAndDiscount() {
        var priceInput = document.getElementById("edit_price");
        var discountInput = document.getElementById("edit_discount");
        var freeCheckbox = document.getElementById("edit_free");

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

    function calculateEditDiscountedPrice() {
        var priceInput = document.getElementById("edit_price");
        var discountInput = document.getElementById("edit_discount");
        var discountedPriceInput = document.getElementById("edit_discountedPrice");

        var price = parseFloat(priceInput.value);
        var discount = parseFloat(discountInput.value);

        if (!isNaN(price) && !isNaN(discount)) {
            var discountedPrice = price - (price * (discount / 100));
            discountedPriceInput.value = discountedPrice.toFixed(); // Display up to 2 decimal places
        } else {
            discountedPriceInput.value = ""; // Clear the discounted price if inputs are not valid numbers
        }
    }

    // Populate edit modal with course data
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.getAttribute('data-id');
            fetch(`/course/${courseId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editCourseForm').setAttribute('action',
                        `/course/${courseId}`);
                    document.getElementById('edit_nama_kursus').value = data.nama_kursus;
                    document.getElementById('edit_category').value = data.kategori_id;
                    document.getElementById('edit_subcategory').value = data.subkategori_id;
                    document.getElementById('edit_tingkat').value = data.tingkat;
                    document.getElementById('edit_content').value = data.content;
                    document.getElementById('edit_price').value = data.price;
                    document.getElementById('edit_discount').value = data.discount;
                    document.getElementById('edit_discountedPrice').value = data.discountedPrice;
                    document.getElementById('edit_free').checked = data.free;

                    // Handle include fields
                    const includeContainer = document.getElementById('edit-include-container');
                    includeContainer.innerHTML = '';
                    data.include.forEach(item => {
                        const inputGroup = document.createElement('div');
                        inputGroup.classList.add('input-group', 'mb-2');
                        inputGroup.innerHTML = `
                            <input type="text" class="form-control" name="include[]" value="${item}">
                            <button class="btn btn-danger remove-edit-include" type="button">-</button>
                        `;
                        includeContainer.appendChild(inputGroup);
                    });

                    // Handle image preview
                    if (data.gambar) {
                        document.getElementById('edit_preview').src = `/storage/${data.gambar}`;
                        document.getElementById('edit_preview').style.display = 'block';
                    } else {
                        document.getElementById('edit_preview').style.display = 'none';
                    }

                    // Trigger subcategory update
                    const categoryId = data.kategori_id;
                    const subcategorySelect = document.getElementById('edit_subcategory');
                    subcategorySelect.disabled = !categoryId;
                    if (categoryId) {
                        fetch(`/get-subcategories/${categoryId}`)
                            .then(response => response.json())
                            .then(subcategories => {
                                subcategorySelect.innerHTML =
                                    '<option value="">Pilih Subkategori</option>';
                                subcategories.forEach(subcategory => {
                                    if (subcategory.status == 1) {
                                        const option = document.createElement('option');
                                        option.value = subcategory.id;
                                        option.textContent = subcategory.name;
                                        if (subcategory.id == data.subkategori_id) {
                                            option.selected = true;
                                        }
                                        subcategorySelect.appendChild(option);
                                    }
                                });
                            })
                            .catch(error => console.error('Error fetching subcategories:', error));
                    } else {
                        subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
                    }
                })
                .catch(error => console.error('Error fetching course data:', error));
        });
    });
</script>
