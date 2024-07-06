<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sub.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="kurikulumIdInput" name="kurikulum_id">
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="nama_sub">Nama Sub</label>
                        <input type="text" class="form-control" id="nama_sub" name="nama_sub" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
