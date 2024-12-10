<div class="modal fade" id="InstrukturModal" tabindex="-1" aria-labelledby="InstrukturModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('regisInstruktur') }}" method="POST" id="regisInstruktur">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="InstrukturModalLabel">Tambah Instruktur Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan Nama" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan Email" required>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telepon <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="Masukkan Nomor Telepon" maxlength="12" required>
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan Password" required>
                    </div>
                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Konfirmasi Password" required>
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
