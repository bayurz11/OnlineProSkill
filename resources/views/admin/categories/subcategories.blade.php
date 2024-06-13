@section('title', 'ProSkill Akademia | subcategory')
<?php $page = 'subcategories'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Subsubcategory</li>
            </ol>
        </nav>

        @include('admin.modal.add_subcategories')
        @include('admin.modal.edit_categories')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Subsubcategory</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Subsubcategory
                        </button>
                        <p class="text-muted mb-3">Jumlah Subsubcategory : {{ $categori->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar Icon</th>
                                        <th>subcategory</th>
                                        <th>Nama Subsubcategory</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategori as $subcategory)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td><img src="{{ asset('public/uploads/' . $subcategory->gambar) }}"
                                                    alt="Banner" class="wd-100 wd-sm-150 me-3"></td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td><a href="#" id="badgeLink"
                                                    class="badge {{ $subcategory->status ? 'bg-success' : 'bg-danger' }}"
                                                    data-id="{{ $subcategory->id }}"
                                                    data-status="{{ $subcategory->status }}">
                                                    {{ $subcategory->status ? 'Active' : 'Inactive' }}
                                                </a>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $subcategory->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>

                                                <button onclick="hapus('{{ $subcategory->id }}')"
                                                    class="btn btn-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>

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
                                                                method: 'POST', // Menggunakan POST bukan DELETE
                                                                headers: {
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                    'Content-Type': 'application/json'
                                                                },
                                                                body: JSON.stringify({
                                                                    _method: 'DELETE'
                                                                }) // Menambahkan _method override
                                                            }).then(response => {
                                                                document.getElementById('confirmationModal').remove();
                                                                if (response.ok) {
                                                                    console.log(
                                                                        'subcategory berhasil dihapus. Mengalihkan ke halaman pengaturan subcategory.');
                                                                    window.location.href = '{{ route('categories') }}';
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
            $('#badgeLink').on('click', function(e) {
                e.preventDefault();

                var link = $(this);
                var categoryId = link.data('id');
                var currentStatus = link.data('status');
                var newStatus = currentStatus ? 0 : 1;

                $.ajax({
                    url: '/update-subcategory-status/' + categoryId,
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
                            alert('Failed to update status');
                        }
                    },
                    error: function() {
                        alert('An error occurred');
                    }
                });
            });
        });
    </script>
@endsection
