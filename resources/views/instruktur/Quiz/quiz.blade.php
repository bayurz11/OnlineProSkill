@section('title', 'ProSkill Akademia | Quiz')
<?php $page = 'instruktur.quiz'; ?>

@extends('layout.mainlayout')
@include('instruktur.modal.quizModal')
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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QuizModal">Tambah
                                Quiz</button>
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
                                                            <p style="font-size: 12px;">Waktu:
                                                                {{ \Carbon\Carbon::parse($quiz->jam_mulai)->format('H.i') }}
                                                                s/d
                                                                {{ \Carbon\Carbon::parse($quiz->jam_akhir)->format('H.i') }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="color-black">{{ $quiz->KelasTatapMuka->nama_kursus }}</p>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $waktuAkhir = \Carbon\Carbon::parse(
                                                                $quiz->created_at->format('Y-m-d') .
                                                                    ' ' .
                                                                    $quiz->jam_akhir,
                                                            );
                                                            $isSelesai = now()->greaterThan($waktuAkhir);
                                                        @endphp
                                                        @if ($isSelesai)
                                                            <span class="dashboard__quiz-result fail">Selesai</span>
                                                        @else
                                                            <span class="dashboard__quiz-result">Berjalan</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dashboard__review-action">
                                                            <a href="#" title="Tambahkan Pertanyaan"><i
                                                                    class="skillgro-edit"></i></a>
                                                            <a href="#" title="Hapus Quiz"
                                                                data-id="{{ $quiz->id_tugas }}" class="delete-quiz"><i
                                                                    class="skillgro-bin"></i></a>
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
                    confirmationModal.style.display = 'flex'; // Show the modal
                });
            });

            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.action = `/instruktur_quiz/${quizId}`;
                deleteForm.submit();
                confirmationModal.style.display = 'none'; // Hide the modal after confirmation
            });

            cancelDeleteBtn.addEventListener('click', function() {
                confirmationModal.style.display = 'none'; // Hide the modal on cancel
            });
        });
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

@endsection
