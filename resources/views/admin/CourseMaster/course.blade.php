@section('title', 'ProSkill Akademia | Course')
<?php $page = 'course'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course</li>
            </ol>
        </nav>

        @include('admin.modal.add_course')
        @include('admin.modal.edit_course')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Course</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Course
                        </button>
                        <p class="text-muted mb-3">Jumlah Course : {{ $categori->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kursus</th>
                                        <th>Kursus Owner</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course as $key => $courses)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>a</td>
                                            <td>a</td>
                                            <td>100000</td>
                                            <td>
                                                <div class="form-check form-switch mb-2">
                                                    <input type="checkbox" class="form-check-input formSwitch"
                                                        id="formSwitch{{ $courses->id }}" data-id="{{ $courses->id }}"
                                                        data-status="{{ $courses->status }}">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-icon" title="Kurikulum">
                                                    <i data-feather="settings"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="#">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                <button onclick="hapus('#')" class="btn btn-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.badgeLink').on('click', function(e) {
                e.preventDefault();

                var link = $(this);
                var categoryId = link.data('id');
                var currentStatus = link.data('status');
                var newStatus = currentStatus ? 0 : 1;

                $.ajax({
                    url: '/update-category-status/' + categoryId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            link.data('status', newStatus);
                            link.text(newStatus ? 'Active' : 'Inactive');
                            if (newStatus) {
                                link.removeClass('bg-danger').addClass('bg-success');
                            } else {
                                link.removeClass('bg-success').addClass('bg-danger');
                            }
                        } else {
                            alert('Gagal mengupdate status');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan');
                    }
                });
            });
        });
    </script>
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
                fetch(`/categories_destroy/${id}`, {
                    method: 'POST',
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
                        console.log('Kategori berhasil dihapus. Mengalihkan ke halaman pengaturan Kategori.');
                        window.location.href = '{{ route('categories') }}';
                    } else {
                        response.text().then(text => {
                            console.error('Gagal menghapus Kategori:', text);
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
