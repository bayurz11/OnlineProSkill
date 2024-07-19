<!-- Edit Modal -->
<div class="modal fade" id="editModalsiswa" tabindex="-1" aria-labelledby="editModalsiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalsiswaLabel">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" hidden>
                        {{-- <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="edit_online"
                                value="online">
                            <label class="form-check-label" for="edit_online">Online Course</label>
                        </div> --}}
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="course_type" id="edit_offline"
                                value="offline">
                            <label class="form-check-label" for="edit_offline">Biodata Siswa</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $daftar->user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Kursus<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_durasi" name="durasi"
                            placeholder="Durasi kursus">
                    </div>
                    <div class="mb-3">
                        <label for="sertifikat" class="form-label">Sertifikat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_sertifikat" name="sertifikat"
                            placeholder="Apakah mendapatkan sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota Perkelas<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_kuota" name="kuota"
                            placeholder="Masukkan Jumlah Kuota yang Disediakan">
                    </div>

                    <div class="mb-3">
                        <label for="edit_subcategory" class="form-label">Subkategori<span
                                class="text-danger">*</span></label>
                        <select id="edit_subcategory" class="form-select" name="subkategori_id" disabled>
                            <option value="">Pilih Subkategori</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tingkat" class="form-label">Tingkat <span class="text-danger">*</span></label>
                        <select id="edit_tingkat" class="form-select" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Lanjutan">Lanjutan</option>
                            <option value="Semua Tingkat">Semua Tingkat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea id="edit_content" name="content" style="height: 400px; width: 100%; font-size: 18px;"></textarea>
                        <input type="hidden" id="edit_content_input" name="content">
                    </div>

                    <div class="mb-3">
                        <label for="edit_include" class="form-label">Yang akan dipelajari <span
                                class="text-danger">*</span></label>
                        <div id="edit-include-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="edit_include" name="include[]">
                                <button class="btn btn-success" type="button" id="add-edit-include">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Harga (Rp)<span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit_discount" class="form-label">Diskon %</label>
                        <input type="text" class="form-control" id="edit_discount" name="discount"
                            oninput="calculateEditDiscountedPrice()">
                    </div>
                    <div class="mb-3">
                        <label for="edit_discountedPrice" class="form-label">Harga Setelah Diskon (Rp)</label>
                        <input type="text" class="form-control" id="edit_discountedPrice" name="discountedPrice"
                            readonly>
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label" for="edit_gambar">Gambar Kursus<span
                                class="text-danger">*</span></label>
                        <input type="file" accept="image/*" class="form-control" id="edit_gambar"
                            name="gambar">
                    </div>
                    <img id="edit_preview" src="#" alt="Preview banner"
                        style="max-width: 100%; max-height: 200px; display: none;">
                    <div class="mb-3">
                        <label for="edit_tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="edit_tag" name="tag">
                        <small class="text-secondary">Note: Isi Dengan Tags kursus yang relevan</small>
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
