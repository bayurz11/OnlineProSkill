@section('title', 'ProSkill Akademia | Facebook Setting')
<?php $page = 'contact'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Facebook Setting</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Facebook Integration Setup</h6>

                        <form action="{{ route('pixel.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function hapus(id) {
            const confirmationBox = `
                <div id="confirmationModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
                    <div style="background: white; padding: 40px; border-radius: 8px; text-align: center;">
                        <h4>Konfirmasi Penghapusan</h4><br>
                        <p>Apakah Anda yakin ingin menghapus ini?</p><br>
                        <button id="confirmDelete" class="btn btn-danger btn-lg">Ya, Hapus</button>
                        <button id="cancelDelete" class="btn btn-secondary btn-lg">Batal</button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', confirmationBox);

            document.getElementById('confirmDelete').onclick = function() {
                fetch(`/contact/${id}/destroy`, {
                    method: 'POST', // Menggunakan POST bukan DELETE
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                }).then(response => {
                    document.getElementById('confirmationModal').remove();
                    if (response.ok) {
                        console.log(
                            'subcategory berhasil dihapus. Mengalihkan ke halaman contact.');
                        window.location.href = '{{ route('settingcontactus') }}';
                    } else {
                        response.text().then(text => {
                            console.error('Gagal menghapus subcategory:', text);
                        });
                    }
                }).catch(error => {
                    document.getElementById('confirmationModal').remove();
                    console.error('Terjadi kesalahan:', error);
                });
            };

            document.getElementById('cancelDelete').onclick = function() {
                document.getElementById('confirmationModal').remove();
            };
        }
    </script>


@endsection
