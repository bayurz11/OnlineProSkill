@section('title', 'ProSkill Akademia | Produk')
<?php $page = 'Produk'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        @include('admin.modal.add_produk')
        @include('admin.modal.edit_produk')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Produk</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Kelas
                        </button>
                        <p class="text-muted mb-3"> Jumlah Produk : {{ $course->count() }}</p>
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
                                            <td>{{ $courses->nama_kursus }}</td>
                                            <td>{{ $courses->user->name }}</td>
                                            <td>
                                                @if ($courses->free)
                                                    Free
                                                @elseif(!empty($courses->discount) && !empty($courses->discountedPrice))
                                                    Rp. {{ number_format($courses->discountedPrice, 0, ',', '.') }}
                                                @else
                                                    Rp. {{ number_format($courses->price, 0, ',', '.') }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="form-check form-switch mb-2">
                                                    <input type="checkbox" class="form-check-input formSwitch"
                                                        id="formSwitch{{ $courses->id }}" data-id="{{ $courses->id }}"
                                                        data-status="{{ $courses->status }}">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('kurikulum', ['id' => $courses->id]) }}"
                                                    class="btn btn-success btn-icon kurikulum-btn"
                                                    data-id="{{ $courses->id }}" title="Kurikulum">
                                                    <i data-feather="settings"></i>
                                                </a>


                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $courses->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>

                                                <button onclick="hapus('{{ $courses->id }}')"
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
                formSwitch.checked = formSwitch.dataset.status == 1;

                formSwitch.addEventListener('change', function() {
                    const categoryId = formSwitch.dataset.id;
                    const newStatus = formSwitch.checked ? 1 : 0;

                    fetch('/update-class-status/' + categoryId, {
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
        //hapus
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

        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const kurikulumButtons = document.querySelectorAll('.kurikulum-btn');

            kurikulumButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const courseId = button.getAttribute('data-id');
                    localStorage.setItem('selectedCourseId', courseId);
                });
            });
        });
    </script>


@endsection
