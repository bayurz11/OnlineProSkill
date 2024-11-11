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

                                                            <h6 class="title">{{ $quiz->judul_tugas }}
                                                            </h6>

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
                                                    {{-- <td>
                                                        <p class="color-black">8</p>
                                                    </td>
                                                    <td>
                                                        <p class="color-black">4</p>
                                                    </td> --}}
                                                    <td>
                                                        <p>Waktu Saat Ini: {{ now()->format('H:i') }}</p>
                                                        <p>Waktu Mulai:
                                                            {{ \Carbon\Carbon::parse($quiz->jam_mulai)->format('H:i') }}</p>
                                                        <p>Waktu Akhir:
                                                            {{ \Carbon\Carbon::parse($quiz->jam_akhir)->format('H:i') }}</p>

                                                        @if (now()->between(\Carbon\Carbon::parse($quiz->jam_mulai), \Carbon\Carbon::parse($quiz->jam_akhir)))
                                                            <span class="dashboard__quiz-result">Berjalan</span>
                                                        @else
                                                            <span class="dashboard__quiz-result fail">Selesai</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="dashboard__review-action">
                                                            <a href="#" title="Edit"><i
                                                                    class="skillgro-edit"></i></a>
                                                            <a href="#" title="Delete"><i
                                                                    class="skillgro-bin"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                            <td>
                                                                <div class="dashboard__quiz-info">
                                                                    <p>February 29, 2024</p>
                                                                    <h6 class="title">Write a short essay on yourself using
                                                                        the 5
                                                                    </h6>
                                                                    <span>Student: <a href="#">John Due</a></span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="color-black">2</p>
                                                            </td>
                                                            <td>
                                                                <p class="color-black">6</p>
                                                            </td>
                                                            <td>
                                                                <p class="color-black">3</p>
                                                            </td>
                                                            <td>
                                                                <span class="dashboard__quiz-result fail">Fail</span>
                                                            </td>
                                                            <td>
                                                                <div class="dashboard__review-action">
                                                                    <a href="#" title="Edit"><i
                                                                            class="skillgro-edit"></i></a>
                                                                    <a href="#" title="Delete"><i
                                                                            class="skillgro-bin"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr> --}}

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengatur tinggi untuk elemen h5.title dalam konteks courses__item-thumb
            var courseTitles = document.querySelectorAll('.courses__item-thumb h5.title');
            var maxCourseTitleHeight = 0;

            // Temukan tinggi maksimum untuk h5.title
            courseTitles.forEach(function(title) {
                if (title.offsetHeight > maxCourseTitleHeight) {
                    maxCourseTitleHeight = title.offsetHeight;
                }
            });

            // Tetapkan tinggi maksimum ke semua elemen h5.title
            courseTitles.forEach(function(title) {
                title.style.height = maxCourseTitleHeight + 'px';
            });
        });
    </script>


@endsection
