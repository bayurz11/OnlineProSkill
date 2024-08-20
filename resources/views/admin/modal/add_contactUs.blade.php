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

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Masukkan Alamat Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="include" class="form-label">Telepon <span class="text-danger">*</span></label>
                        <div id="include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-include">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="includemail" class="form-label">Alamat Email <span
                                class="text-danger">*</span></label>
                        <div id="includemail-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="includemail" name="includemail[]">
                                <button class="btn btn-success" type="button" id="add-includemail">+</button>
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
    // Include fields handling
    document.addEventListener('DOMContentLoaded', function() {
        const addIncludeButton = document.getElementById('add-includemail');
        const includeContainer = document.getElementById('includemail-container');

        addIncludeButton.addEventListener('click', function() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
            <input type="text" class="form-control" name="includemail[]">
            <button class="btn btn-danger remove-includemail" type="button">-</button>
        `;
            includeContainer.appendChild(newInputGroup);

            newInputGroup.querySelector('.remove-includemail').addEventListener('click', function() {
                newInputGroup.remove();
            });
        });

        includeContainer.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-includemail')) {
                event.target.closest('.input-group').remove();
            }
        });
    });
</script>
