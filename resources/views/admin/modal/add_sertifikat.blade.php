<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan Nama ">
                    </div>
                    <div class="mb-3">
                        <label for="sertifikat_id" class="form-label">ID Sertifikat<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sertifikat_id" name="sertifikat_id"
                            placeholder="Masukkan ID Sertifikat">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gambar">Sertifikat<span class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar">
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Masukkan Keterangan">
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
</script>
