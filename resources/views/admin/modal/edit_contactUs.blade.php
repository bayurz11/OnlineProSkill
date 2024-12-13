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
                        <label for="edittelepon" class="form-label">Tetepon<span class="text-danger">*</span></label>
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
        // Menangani klik tombol edit
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');

            // Fetch data untuk mengisi form
            fetch(`/contact/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Memasukkan data ke input form
                    $('#editalamat').val(data.alamat || '');

                    // Memasukkan telepon
                    populateContainer('#telepon-container', data.telepon, 'telepon');

                    // Memasukkan email
                    populateContainer('#email-container', data.email, 'email');

                    // Mengatur aksi form untuk rute pembaruan
                    $('#editcontactModalForm').attr('action', `/contact/${data.id}/update`);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
                });
        });

        // Fungsi untuk mengisi container input dinamis
        function populateContainer(containerSelector, data, name) {
            const container = $(containerSelector);
            container.html(''); // Kosongkan kontainer

            try {
                const dataList = JSON.parse(data);
                if (Array.isArray(dataList)) {
                    dataList.forEach(item => {
                        const inputGroup = $(
                            `<div class="input-group mb-2">
                            <input type="${name === 'email' ? 'email' : 'text'}" class="form-control" name="${name}[]" value="${item}" placeholder="Masukkan ${name}">
                            <button class="btn btn-danger remove-${name}" type="button">-</button>
                        </div>`
                        );
                        container.append(inputGroup);
                    });
                } else {
                    console.warn(`${name} bukan array:`, dataList);
                }
            } catch (e) {
                console.error(`Error parsing ${name}:`, e);
            }
        }

        // Menambah input baru untuk telepon
        $('#add-telepon').on('click', function() {
            addInput('#telepon-container', 'telepon', 'text');
        });

        // Menambah input baru untuk email
        $('#add-email').on('click', function() {
            addInput('#email-container', 'email', 'email');
        });

        // Fungsi untuk menambah input baru
        function addInput(containerSelector, name, type) {
            const inputGroup = $(
                `<div class="input-group mb-2">
                <input type="${type}" class="form-control" name="${name}[]" placeholder="Masukkan ${name}">
                <button class="btn btn-danger remove-${name}" type="button">-</button>
            </div>`
            );
            $(containerSelector).append(inputGroup);
        }

        // Menghapus input telepon atau email
        $(document).on('click', '.remove-telepon, .remove-email', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
