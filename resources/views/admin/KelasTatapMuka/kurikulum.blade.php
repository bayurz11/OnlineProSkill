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
        @include('admin.modal.edit_section')

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
                        <p class="text-muted mb-3"> Jumlah Pertemuan : {{ $kurikulum->count() }}</p>
                        <div class="table-responsive">
                            @foreach ($kurikulum as $kuri)
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div>
                                                Bagian {{ $kuri->no_urut }}. {{ $kuri->title }}
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalEdit"
                                                    title="Edit Kurikulum" data-id="{{ $kuri->id }}">
                                                    <i class="btn-icon-prepend" data-feather="edit"></i>
                                                </button>
                                                <button onclick="hapus('{{ $kuri->id }}')"
                                                    class="btn btn-outline-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-id="{{ $kuri->id }}"
                                                    data-bs-target="#materiModal">
                                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> Tambah
                                                    Materi
                                                </button>
                                            </div>
                                        </div>

                                        @foreach ($kuri->sections as $section)
                                            <div class="card">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    Pelajaran {{ $section->no_urut }}. {{ $section->title }}
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#sectionModalEdit"
                                                            title="Edit Section" data-id="{{ $section->id }}">
                                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                                        </button>
                                                        <button onclick="hapus1('{{ $section->id }}')"
                                                            class="btn btn-outline-danger btn-icon" title="Hapus">
                                                            <i data-feather="trash-2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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

        function hapus1(id) {
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
                const sectionId = this.getAttribute('data-id');
                $.ajax({
                    url: `/section_destroy/${sectionId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        document.getElementById('confirmationModal').remove();
                        console.log('Section berhasil dihapus. Mengalihkan ke halaman kurikulum.');
                        location.reload(); // Refresh halaman setelah penghapusan berhasil
                    },
                    error: function(xhr) {
                        document.getElementById('confirmationModal').remove();
                        console.error('Gagal menghapus Section:', xhr.responseText);
                    }
                });
            };

            document.getElementById('cancelDelete').onclick = function() {
                document.getElementById('confirmationModal').remove();
            };
        }
    </script>
@endsection
