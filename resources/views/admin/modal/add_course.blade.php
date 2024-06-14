<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select id="category" class="js-example-basic-single form-select" name="name_category"
                            data-width="100%">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categori as $category)
                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Subkategori</label>
                        <select id="subcategory" class="form-control" name="name_course" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>
                    <div class="mb-3">
                        <label for="name_course" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="name_course" name="name_course"
                            placeholder="Masukkan Nama Kursus Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gambar">Icon Kategori</label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar">
                    </div>
                    <img id="preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">

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
</script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Initialize Select2
        $('#category').select2();
        $('#subcategory').select2();

        // Fetch subcategories based on category selection
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append(
                            '<option value="">Pilih Subkategori</option>');
                        $.each(data, function(key, value) {
                            $('#subcategory').append('<option value="' + value.id +
                                '">' + value.name_subcategory + '</option>');
                        });
                        $('#subcategory').prop('disabled', false);
                    }
                });
            } else {
                $('#subcategory').empty();
                $('#subcategory').append('<option value="">Pilih Subkategori</option>');
                $('#subcategory').prop('disabled', true);
            }
        });
    });
</script>
