<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('storeclas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kursus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" hidden>
                        {{-- <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="online"
                                value="online">
                            <label class="form-check-label" for="online">
                                Online Course
                            </label>
                        </div> --}}
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="offline"
                                value="offline" checked>
                            <label class="form-check-label" for="offline">
                                Offline Class
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kursus" class="form-label">Nama Kursus<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kursus" name="nama_kursus"
                            placeholder="Masukkan Nama Kursus Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Kursus<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="durasi" name="durasi"
                            placeholder="durasi kursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="sertifikat" class="form-label">Sertifikat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sertifikat" name="sertifikat"
                            placeholder="apakah mendapatkan sertifikat" required>
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota Perkelas<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="kuota" name="kuota"
                            placeholder="Masukkan Jumlah Kuota yang Disediakan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="category" class="js-example-basic-single form-select" name="kategori_id"
                            data-width="100%" required>
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
                        <select id="subcategory" class="form-control" name="subkategori_id" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tingkat" class="form-label">Tingkat <span class="text-danger">*</span></label>
                        <select id="tingkat" class="form-select" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Lanjutan">Lanjutan</option>
                            <option value="Semua Tingkat">Semua Tingkat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Deskripsi<span class="text-danger">*</span></label>
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
                        <label for="include" class="form-label">Apa yang akan di pelajari <span
                                class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="perstaratan" class="form-label">Persyaratan Kelas <span
                                class="text-danger">*</span></label>
                        <div id="perstaratan-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="perstaratan" name="perstaratan[]">
                                <button class="btn btn-success" type="button" id="add-perstaratan">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="discount" name="discount"
                            oninput="calculateDiscountedPrice()">
                    </div>

                    <div class="mb-3">
                        <label for="discountedPrice">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="discountedPrice" name="discountedPrice"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar"
                            required>
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

                    <div class="mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag">
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

    // Include fields handling
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

            newInputGroup.querySelector('.remove-include').addEventListener('click', function() {
                newInputGroup.remove();
            });
        });

        includeContainer.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-include')) {
                event.target.closest('.input-group').remove();
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const addperstaratanButton = document.getElementById('add-perstaratan');
        const perstaratanContainer = document.getElementById('perstaratan-container');

        addperstaratanButton.addEventListener('click', function() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
                <input type="text" class="form-control" name="perstaratan[]" >
                <button class="btn btn-danger remove-perstaratan" type="button">-</button>
            `;
            perstaratanContainer.appendChild(newInputGroup);

            newInputGroup.querySelector('.remove-perstaratan').addEventListener('click', function() {
                newInputGroup.remove();
            });
        });

        perstaratanContainer.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-perstaratan')) {
                event.target.closest('.input-group').remove();
            }
        });
    });

    // Kategori dan Subkategori handling
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
                            if (subcategory.status == 1) {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.name;
                                subcategorySelect.appendChild(option);
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
            }
        });
    });

    // Price and discount handling
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

    function calculateDiscountedPrice() {
        var priceInput = document.getElementById("price");
        var discountInput = document.getElementById("discount");
        var discountedPriceInput = document.getElementById("discountedPrice");

        var price = parseFloat(priceInput.value);
        var discount = parseFloat(discountInput.value);

        if (!isNaN(price) && !isNaN(discount)) {
            var discountedPrice = price - (price * (discount / 100));
            discountedPriceInput.value = discountedPrice.toFixed(); // Display up to 2 decimal places
        } else {
            discountedPriceInput.value = ""; // Clear the discounted price if inputs are not valid numbers
        }
    }
</script>
