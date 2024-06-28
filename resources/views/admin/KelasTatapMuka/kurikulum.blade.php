@section('title', 'ProSkill Akademia | Kelas Tatap Muka')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('classroomsetting') }}">Kelas Tatap Muka</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kurikulum</li>
            </ol>
        </nav>
        {{-- 
        @include('admin.modal.add_clasroom')
        @include('admin.modal.edit_clasroom') --}}

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kurikulum</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-12 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Kurikulum
                        </button>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Sub
                        </button>
                        <p class="text-muted mb-3"> Jumlah Kurikulum : {{ $course->count() }}</p>
                        <div class="table-responsive">
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
    </script>


@endsection
