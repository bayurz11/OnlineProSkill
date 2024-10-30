@section('title', 'ProSkill Akademia | Kurikulum')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')
    @include('instruktur.modal.modalKurikulumedit')
    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="{{ asset('public/assets/img/bg/breadcrumb_bg.jpg') }}">
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape01.svg') }}" alt="img" class="alltuchtopdown">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape02.svg') }}" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape03.svg') }}" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape04.svg') }}" alt="img"
                data-aos="fade-down-left" data-aos-delay="400">
            <img src="{{ asset('public/assets/img/others/breadcrumb_shape05.svg') }}" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Kurikulum</h4>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#kurikulumModal" data-id="{{ $kelas->id }}">
                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> + Kurikulum Baru
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-body">

                                <p class="text-muted mb-3">Jumlah Pertemuan: {{ $kurikulum->count() }}</p>
                                <div class="table-responsive">
                                    @foreach ($kurikulum as $kuri)
                                        <div class="col-md-12 grid-margin stretch-card mb-2">
                                            <div class="card">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    <div>
                                                        Bagian {{ $kuri->no_urut }}. {{ $kuri->title }}
                                                    </div>
                                                    <div class="dashboard__review-action">
                                                        <a href="" title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#kurikulumModalEdit"
                                                            data-id="{{ $kuri->id }}">
                                                            <i class="skillgro-edit"></i>
                                                        </a>
                                                        <a href="" title="Delete"
                                                            onclick="hapus('{{ $kuri->id }}')">
                                                            <i class="skillgro-bin"></i>
                                                        </a>
                                                        <a href="" title="Tambah Materi" data-bs-toggle="modal"
                                                            data-id="{{ $kuri->id }}" data-bs-target="#materiModal">
                                                            <i class="skillgro-plus-circle">+ Materi Baru</i>
                                                        </a>
                                                    </div>
                                                </div>

                                                @foreach ($kuri->sections as $section)
                                                    <div class="card mt-2">
                                                        <!-- Tambahkan margin-top untuk memberi jarak antar card -->
                                                        <div class="card-body d-flex justify-content-between align-items-center"
                                                            style="padding-left: 1.5rem; padding-right: 1.5rem;">
                                                            Pelajaran {{ $section->no_urut }}. {{ $section->title }}
                                                            <div class="dashboard__review-action">
                                                                <a href="#" title="Edit" data-bs-toggle="modal"
                                                                    data-bs-target="#sectionModalEdit"
                                                                    data-id="{{ $section->id }}">
                                                                    <i class="skillgro-edit"></i>
                                                                </a>
                                                                <a href="#" title="Delete"
                                                                    onclick="hapus1('{{ $section->id }}')">
                                                                    <i class="skillgro-bin"></i>
                                                                </a>
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

        </div>
    </section>
    <!-- dashboard-area-end -->
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
                    url: `/instruktur_kurikulum_destroy/${kurikulumId}`,
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
        document.addEventListener('DOMContentLoaded', function() {
            const kurikulumModalEdit = document.getElementById('kurikulumModalEdit');

            kurikulumModalEdit.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Tombol yang diklik
                const kurikulumId = button.getAttribute('data-id');

                // Fetch data dari controller untuk modal
                fetch(`/instruktur_kurikulum/${kurikulumId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_kurikulum_id').value = data.id;
                        document.getElementById('edittitle').value = data.title;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
