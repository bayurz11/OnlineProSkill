@section('title', 'ProSkill Akademia | Quiz')
<?php $page = 'instruktur.quiz'; ?>

@extends('layout.mainlayout')
@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
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
                        <div class="dashboard__content-title d-flex justify-content-between align-items-center">
                            <h4 class="title">Quiz</h4>
                            <button class="btn btn-primary" onclick="showModal()">
                                Tambah Quiz
                            </button>

                        </div>

                        <div class="row">

                            <div class="col-12">
                                <div class="dashboard__review-table">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Quiz</th>
                                                <th>Course Name</th>
                                                {{-- <th>TM</th>
                                                <th>CA</th> --}}
                                                <th>Keterangan</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>

                                        @foreach ($quiz as $quiz)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="dashboard__quiz-info">
                                                            <p>{{ $quiz->created_at->format('d F, Y') }}</p>
                                                            <h6 class="title">{{ $quiz->judul_tugas }}</h6>
                                                            <p style="font-size: 12px;">
                                                                Tanggal:
                                                                {{ \Carbon\Carbon::parse($quiz->tanggal_mulai)->format('d F, Y') }}
                                                                s/d
                                                                {{ \Carbon\Carbon::parse($quiz->tanggal_akhir)->format('d F, Y') }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="color-black">{{ $quiz->KelasTatapMuka->nama_kursus }}</p>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $tanggalAkhir = \Carbon\Carbon::parse(
                                                                $quiz->tanggal_akhir,
                                                            )->endOfDay();
                                                            $isSelesai = now()->greaterThan($tanggalAkhir);
                                                        @endphp
                                                        @if ($isSelesai)
                                                            <span class="dashboard__quiz-result fail">Selesai</span>
                                                        @else
                                                            <span class="dashboard__quiz-result">Berjalan</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('kurikulum', ['id' => $courses->id]) }}"
                                                            class="btn btn-success btn-icon kurikulum-btn"
                                                            data-id="{{ $courses->id }}" title="Kurikulum">
                                                            <i data-feather="settings"></i>
                                                        </a>


                                                        <button type="button" class="btn btn-primary btn-icon edit-button"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-id="{{ $courses->id }}">
                                                            <i data-feather="edit"></i>
                                                        </button>

                                                        <button onclick="hapus('{{ $courses->id }}')"
                                                            class="btn btn-danger btn-icon" title="Hapus">
                                                            <i data-feather="trash-2"></i>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <div class="dashboard__review-action">
                                                            <a href="{{ route('instruktur_view_pg', $quiz->id_tugas) }}"
                                                                title="Lihat Soal">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="#" title="Hapus Quiz"
                                                                data-id="{{ $quiz->id_tugas }}" class="delete-quiz">
                                                                <i class="skillgro-bin"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach


                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- dashboard-area-end -->
    <!-- Form untuk penghapusan dengan JavaScript -->
    <form id="delete-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.delete-quiz');
            const deleteForm = document.getElementById('delete-form');
            const confirmationModal = document.getElementById('confirmationModal');
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            const cancelDeleteBtn = document.getElementById('cancelDelete');

            let quizId; // Variable to store quiz ID for deletion

            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    quizId = this.getAttribute('data-id');
                    confirmationModal.style.display = 'flex';
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.action = `/instruktur_quiz/${quizId}`;
                deleteForm.submit();
                confirmationModal.style.display = 'none';
            });

            cancelDeleteBtn.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
            });
        });

        function showModal() {
            document.getElementById('confirmationModalQuestion').style.display = 'flex';
        }

        function hideModal() {
            document.getElementById('confirmationModalQuestion').style.display = 'none';
        }
    </script>

    <!-- HTML for the modal -->
    <div id="confirmationModal"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: white; padding: 40px; border-radius: 8px; text-align: center;">
            <h4>Konfirmasi Penghapusan</h4><br>
            <p>Apakah Anda yakin ingin menghapus quiz ini?</p><br>
            <button id="confirmDelete" class="btn btn-danger btn-lg">Ya, Hapus</button>
            <button id="cancelDelete" class="btn btn-secondary btn-lg">Batal</button>
        </div>
    </div>
    <div id="confirmationModalQuestion"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: white; padding: 40px; border-radius: 8px; text-align: center; position: relative;">
            <h4>Pilih Jenis Pertanyaan</h4><br>
            <p>Silakan pilih jenis pertanyaan yang ingin ditambahkan.</p><br>
            <!-- Button menuju halaman pilihan ganda -->
            <a href="{{ route('instruktur_question_pg') }}" class="btn btn-primary btn-lg">Pilihan Ganda</a>
            <!-- Button menuju halaman esai -->
            {{-- <a href="{{ route('instruktur_question_essay', ['id_tugas' => $quiz->id_tugas]) }}"
                class="btn btn-secondary btn-lg">Esai</a> --}}
            <!-- Tombol X di pojok kanan atas -->
            <button onclick="hideModal()"
                style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 24px; color: #333;">&times;</button>

            <button onclick="hideModal()" class="btn btn-danger btn-lg"
                style="background-color: #6c757d; border-color: #6c757d; color: white;">Batal</button>


        </div>
    </div>
@endsection
