<!-- Edit Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editcontactModal" tabindex="-1" aria-labelledby="editcontactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editcontactModalForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editcontactModalLabel">Edit Kontak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editalamat" name="alamat"
                            placeholder="Masukkan Alamat Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                        <div id="telepon-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edittelepon" name="telepon[]">
                                <button class="btn btn-success" type="button" id="add-telepon">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <div id="email-container">
                            <div class="input-group mb-2">
                                <input type="email" class="form-control" id="email" name="email[]">
                                <button class="btn btn-success" type="button" id="add-email">+</button>
                            </div>
                        </div>
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
        // Handle the edit button click event
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/contact/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Populate the form fields with fetched data
                    $('#editalamat').val(data.alamat);

                    // Populate telepon fields
                    $('#edittelepon-container').empty(); // Clear the container first
                    data.telepon.forEach((telepon, index) => {
                        $('#edittelepon-container').append(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="telepon[]" value="${telepon}">
                            ${index === 0 ? '<button class="btn btn-success" type="button" id="add-telepon">+</button>' : '<button class="btn btn-danger remove-telepon" type="button">-</button>'}
                        </div>
                    `);
                    });

                    // Populate email fields
                    $('#editemail-container').empty(); // Clear the container first
                    data.email.forEach((email, index) => {
                        $('#editemail-container').append(`
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" name="email[]" value="${email}">
                            ${index === 0 ? '<button class="btn btn-success" type="button" id="add-email">+</button>' : '<button class="btn btn-danger remove-email" type="button">-</button>'}
                        </div>
                    `);
                    });

                    // Set the form action to the update route
                    $('#editeditcontactModalForm').attr('action', `/contact/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        // Add new input fields for telepon
        $(document).on('click', '#editadd-telepon', function() {
            $('#edittelepon-container').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="telepon[]" placeholder="Masukkan nomor telepon">
                <button class="btn btn-danger remove-telepon" type="button">-</button>
            </div>
        `);
        });

        // Remove telepon input fields
        $(document).on('click', '.remove-telepon', function() {
            $(this).closest('.input-group').remove();
        });

        // Add new input fields for email
        $(document).on('click', '#editadd-email', function() {
            $('#editemail-container').append(`
            <div class="input-group mb-2">
                <input type="email" class="form-control" name="email[]" placeholder="Masukkan alamat email">
                <button class="btn btn-danger remove-email" type="button">-</button>
            </div>
        `);
        });

        // Remove email input fields
        $(document).on('click', '.remove-email', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
