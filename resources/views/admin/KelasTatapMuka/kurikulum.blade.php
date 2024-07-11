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
        $(document).ready(function() {
            // Set ID to hidden input when showing edit modal
            $('#exampleModalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var kurikulumId = button.data('id');
                $('#course_id').val(kurikulumId);

                $.ajax({
                    url: '/kurikulum/' + kurikulumId + '/edit',
                    method: 'GET',
                    success: function(response) {
                        $('#edittitle').val(response.title);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                    }
                });
            });
        });

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
                fetch(`/class_destroy/${id}`, {
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
                            'subcategory berhasil dihapus. Mengalihkan ke halaman pengaturan subcategory.');
                        window.location.href = '{{ route('classroomsetting') }}';
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
