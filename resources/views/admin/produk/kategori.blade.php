@section('title', 'ProSkill Akademia | Kategori Produk')
<?php $page = 'main_categories'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
            </ol>
        </nav>

        @include('admin.modal.add_kategori_produk')
        @include('admin.modal.edit_categories')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kategori</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Kategori
                        </button>
                        <p class="text-muted mb-3">Jumlah Kategori : {{ $categori->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Kategori</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categori as $key => $kategori)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $kategori->name_kategori }}</td>
                                            <td>

                                                <div class="form-check form-switch mb-2">
                                                    <input type="checkbox" class="form-check-input formSwitch"
                                                        id="formSwitch{{ $kategori->id }}" data-id="{{ $kategori->id }}"
                                                        data-status="{{ $kategori->status }}">
                                                </div>


                                                {{-- <a href="#"
                                                    class="badge badgeLink {{ $kategori->status ? 'bg-success' : 'bg-danger' }}"
                                                    data-id="{{ $kategori->id }}" data-status="{{ $kategori->status }}">
                                                    {{ $kategori->status ? 'Active' : 'Inactive' }}
                                                </a> --}}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $kategori->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                <button onclick="hapus('{{ $kategori->id }}')"
                                                    class="btn btn-danger btn-icon" title="Hapus">
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
        document.addEventListener('DOMContentLoaded', function() {
            const formSwitches = document.querySelectorAll('.formSwitch');

            formSwitches.forEach(function(formSwitch) {


                // Set initial state of the switch based on the status
                formSwitch.checked = formSwitch.dataset.status == 1;

                formSwitch.addEventListener('change', function() {
                    const categoryId = formSwitch.dataset.id;
                    const newStatus = formSwitch.checked ? 1 : 0;

                    fetch('/update-category-status/' + categoryId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                formSwitch.dataset.status = newStatus;

                            } else {
                                alert('Gagal mengupdate status');
                            }
                        })
                        .catch(() => {
                            alert('Terjadi kesalahan');
                        });
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
