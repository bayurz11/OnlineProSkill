<!-- Modal -->
<div class="modal fade" id="CoursesModal" tabindex="-1" aria-labelledby="CoursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CoursesModalLabel">Create a New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data"
                    id="createCourseForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tipe Kursus<span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="online"
                                value="online" checked>
                            <label class="form-check-label" for="online">Online Course</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="offline"
                                value="offline">
                            <label class="form-check-label" for="offline">Offline Class</label>
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
                            placeholder="Durasi kursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="sertifikat" class="form-label">Sertifikat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sertifikat" name="sertifikat"
                            placeholder="Apakah mendapatkan sertifikat" required>
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota Perkelas<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="kuota" name="kuota"
                            placeholder="Masukkan Jumlah Kuota yang Disediakan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id="category" class="form-select" name="kategori_id" required>
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
                        <label for="tingkat" class="form-label">Tingkat<span class="text-danger">*</span></label>
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
                        <textarea id="content" name="content" style="height: 100px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="content_input" name="content" required>
                        <script>
                            ClassicEditor.create(document.querySelector('#content'))
                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                        document.querySelector('#content_input').value = editor.getData();
                                    });
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                    </div>
                    <div class="mb-3">
                        <label for="include" class="form-label">Yang Akan Dipelajari<span
                                class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="perstaratan" class="form-label">Persyaratan<span
                                class="text-danger">*</span></label>
                        <div id="perstaratan-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="perstaratan[]">
                                <button class="btn btn-success" type="button" id="add-perstaratan">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga (Rp)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" min="0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Diskon %</label>
                        <input type="number" class="form-control" id="discount" name="discount" min="0"
                            value="0" oninput="calculateDiscountedPrice()">
                        <small class="text-secondary">Note: Isi Dengan 0 jika tidak memiliki diskon</small>
                    </div>
                    <div class="mb-3">
                        <label for="discountedPrice" class="form-label">Harga Setelah Diskon (Rp)</label>
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
                        <small class="text-secondary">Note: Isi Dengan Tags kursus yang relevan</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createCourseForm">Create Course</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Add dynamic fields for include and requirements
    document.getElementById('add-include').addEventListener('click', function() {
        let container = document.getElementById('include-container');
        let newInput = document.createElement('div');
        newInput.classList.add('input-group', 'mb-2');
        newInput.innerHTML =
            `<input type="text" class="form-control" name="include[]">
                              <button class="btn btn-danger" type="button" onclick="this.parentElement.remove()">-</button>`;
        container.appendChild(newInput);
    });

    document.getElementById('add-perstaratan').addEventListener('click', function() {
        let container = document.getElementById('perstaratan-container');
        let newInput = document.createElement('div');
        newInput.classList.add('input-group', 'mb-2');
        newInput.innerHTML =
            `<input type="text" class="form-control" name="perstaratan[]">
                              <button class="btn btn-danger" type="button" onclick="this.parentElement.remove()">-</button>`;
        container.appendChild(newInput);
    });

    // Calculate discounted price
    function calculateDiscountedPrice() {
        let price = parseFloat(document.getElementById('price').value) || 0;
        let discountInput = document.getElementById('discount');
        let discount = parseFloat(discountInput.value) || 0;
        let discountedPriceInput = document.getElementById('discountedPrice');

        // Enable or disable discounted price input based on discount input
        if (discountInput.value.trim() === '') {
            discountedPriceInput.value = '';
            discountedPriceInput.setAttribute('readonly', true);
        } else {
            discountedPriceInput.removeAttribute('readonly');
            let discountedPrice = price - (price * (discount / 100));
            discountedPriceInput.value = discountedPrice.toFixed(2);
        }
    }

    // Initial setup to make sure discounted price is readonly
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('discountedPrice').setAttribute('readonly', true);
    });

    // Image preview
    document.getElementById('gambar').addEventListener('change', function() {
        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
