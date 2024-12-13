<!-- Edit Modal -->
<div class="modal fade" id="editcontactModal" tabindex="-1" aria-labelledby="editcontactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editcontactModalForm" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editcontactModalLabel">Edit Kontak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editalamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editalamat" name="alamat"
                            placeholder="Masukkan Alamat Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="edittelepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edittelepon" name="telepon"
                            placeholder="Masukkan Nomor Telepon Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="editemail" class="form-label">Alamat Email <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="editemail" name="email"
                            placeholder="Masukkan Email Anda" required>
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
        // Fetch data when the edit button is clicked
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            fetch(`/contact/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    $('#editalamat').val(data.alamat);
                    $('#edittelepon').val(data.telepon);
                    $('#editemail').val(data.email);

                    // Set the form action to the update route
                    $('#editcontactModalForm').attr('action', `/contact/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Gagal mengambil data kontak');
                });
        });
    });
</script>
