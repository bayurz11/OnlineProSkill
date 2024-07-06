<div class="modal fade" id="kurikulumModal" tabindex="-1" role="dialog" aria-labelledby="kurikulumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kurikulumModalLabel">Tambah Kurikulum</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kurikulumstore') }}" method="POST">
                    @csrf
                    <input type="hidden" id="kurikulumIdInput" name="kurikulum_id">
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="nama_kurikulum">Nama Kurikulum</label>
                        <input type="text" class="form-control" id="nama_kurikulum" name="nama_kurikulum" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
