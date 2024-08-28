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
                        <label for="editalamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editalamat" name="alamat"
                            placeholder="Masukkan Alamat Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="edittelepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                        <div id="telepon-container">
                            <!-- Input telepon akan dinamis di sini -->
                        </div>
                        <button class="btn btn-success" type="button" id="add-telepon">Tambah Telepon</button>
                    </div>
                    <div class="mb-3">
                        <label for="editemail" class="form-label">Alamat Email <span
                                class="text-danger">*</span></label>
                        <div id="email-container">
                            <!-- Input email akan dinamis di sini -->
                        </div>
                        <button class="btn btn-success" type="button" id="add-email">Tambah Email</button>
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
        // Menangani klik tombol edit
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/contact/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Memasukkan data alamat
                    $('#editalamat').val(data.alamat);

                    // Mengelola telepon
                    const teleponContainer = $('#telepon-container');
                    teleponContainer.html('');

                    try {
                        const teleponList = JSON.parse(data.telepon);

                        if (Array.isArray(teleponList)) {
                            teleponList.forEach(item => {
                                const inputGroup = $(`
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="telepon[]" value="${item}">
                                    <button class="btn btn-danger remove-telepon" type="button">-</button>
                                </div>
                            `);
                                teleponContainer.append(inputGroup);
                            });
                        } else {
                            console.error('Parsed telepon bukan array:', teleponList);
                        }
                    } catch (e) {
                        console.error('Error parsing telepon:', e, data.telepon);
                    }

                    // Mengelola email
                    const emailContainer = $('#email-container');
                    emailContainer.html('');

                    try {
                        const emailList = JSON.parse(data.email);

                        if (Array.isArray(emailList)) {
                            emailList.forEach(item => {
                                const inputGroup = $(`
                                <div class="input-group mb-2">
                                    <input type="email" class="form-control" name="email[]" value="${item}">
                                    <button class="btn btn-danger remove-email" type="button">-</button>
                                </div>
                            `);
                                emailContainer.append(inputGroup);
                            });
                        } else {
                            console.error('Parsed email bukan array:', emailList);
                        }
                    } catch (e) {
                        console.error('Error parsing email:', e, data.email);
                    }

                    // Mengatur aksi form untuk rute pembaruan
                    $('#editcontactModalForm').attr('action', `/contact/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        // Menambah input baru untuk telepon
        $(document).on('click', '#add-telepon', function() {
            $('#telepon-container').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="telepon[]" placeholder="Masukkan nomor telepon">
                <button class="btn btn-danger remove-telepon" type="button">-</button>
            </div>
        `);
        });

        // Menghapus input telepon
        $(document).on('click', '.remove-telepon', function() {
            $(this).closest('.input-group').remove();
        });

        // Menambah input baru untuk email
        $(document).on('click', '#add-email', function() {
            $('#email-container').append(`
            <div class="input-group mb-2">
                <input type="email" class="form-control" name="email[]" placeholder="Masukkan alamat email">
                <button class="btn btn-danger remove-email" type="button">-</button>
            </div>
        `);
        });

        // Menghapus input email
        $(document).on('click', '.remove-email', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
