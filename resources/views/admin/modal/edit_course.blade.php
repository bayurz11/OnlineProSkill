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

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 
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
</script> --}}
