@section('title', 'ProSkill Akademia | Daftar Instruktur')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Siswa</li>
            </ol>
        </nav>
        @include('admin.modal.edit_siswa')
        {{-- @include('admin.modal.add_instruktur') --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Daftar Siswa</h6>

                        <p class="text-muted mb-3"> Jumlah Siswa : {{ $daftar_siswa->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftar_siswa as $daftar)
                                        <tr>
                                            <td><img src="{{ $daftar && $daftar->gambar ? (strpos($daftar->gambar, 'googleusercontent') !== false ? $daftar->gambar : asset('public/uploads/' . $daftar->gambar)) : asset('public/assets/img/default_image.jpg') }}"
                                                    alt="Banner" class="wd-100 wd-sm-150 me-3"></td>
                                            </td>
                                            <td>{{ $daftar->user->name }}</td>
                                            <td>{{ $daftar->user->email }}</td>
                                            <td>
                                                <div class="form-check form-switch mb-2">
                                                    <input type="checkbox" class="form-check-input formSwitch"
                                                        id="formSwitch{{ $daftar->user_id }}"
                                                        data-id="{{ $daftar->user_id }}"
                                                        data-status="{{ $daftar->user->status }}">
                                                </div>


                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModalsiswa"
                                                    data-id="{{ $daftar->user_id }}">
                                                    <i data-feather="edit"></i>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formSwitches = document.querySelectorAll('.formSwitch');

            formSwitches.forEach(function(formSwitch) {
                // Set initial state of the switch based on the status
                formSwitch.checked = formSwitch.dataset.status == 1;

                formSwitch.addEventListener('change', function() {
                    const UserId = formSwitch.dataset.id;
                    const newStatus = formSwitch.checked ? 1 : 0;

                    fetch('/update-daftar_siswa/' + UserId, {
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
    </script>

@endsection
