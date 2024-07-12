@extends('layout.mainlayout_admin')

@section('title', 'ProSkill Akademia | Kurikulum')
<?php $page = 'Ofline_class'; ?>

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('classroomsetting') }}">Kelas Tatap Muka</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kurikulum</li>
            </ol>
        </nav>

        @include('admin.modal.add_kurikulum')
        @include('admin.modal.add_materi')
        @include('admin.modal.edit_kurikulum')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kurikulum</h6>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#kurikulumModal" data-id="new">
                                <i class="btn-icon-prepend" data-feather="plus-circle"></i> Kurikulum
                            </button>
                        </div><br>
                        <p class="text-muted mb-3"> Jumlah Kurikulum : {{ $kurikulum->count() }}</p>
                        <div class="table-responsive">
                            @foreach ($kurikulum as $kurikulum)
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div>
                                                {{ $kurikulum->no_urut }}. {{ $kurikulum->title }}
                                            </div>
                                            <div>
                                                Materi
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalEdit"
                                                    title="Edit Kurikulum" data-id="{{ $kurikulum->id }}">
                                                    <i class="btn-icon-prepend" data-feather="edit"></i>
                                                </button>
                                                <button onclick="hapus('{{ $kurikulum->id }}')"
                                                    class="btn btn-outline-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#materiModal">
                                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> Tambah Sub
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        <button id="confirmDelete" class="btn btn-danger btn-lg" data-id="${id}">Ya, Hapus</button>
                        <button id="cancelDelete" class="btn btn-secondary btn-lg">Batal</button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', confirmationBox);

            document.getElementById('confirmDelete').onclick = function() {
                const kurikulumId = this.getAttribute('data-id');
                $.ajax({
                    url: `/kurikulum_destroy/${kurikulumId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        document.getElementById('confirmationModal').remove();
                        console.log('Kurikulum berhasil dihapus. Mengalihkan ke halaman kurikulum.');
                        location.reload(); // Refresh halaman setelah penghapusan berhasil
                    },
                    error: function(xhr) {
                        document.getElementById('confirmationModal').remove();
                        console.error('Gagal menghapus kurikulum:', xhr.responseText);
                    }
                });
            };

            document.getElementById('cancelDelete').onclick = function() {
                document.getElementById('confirmationModal').remove();
            };
        }
    </script>
@endsection
