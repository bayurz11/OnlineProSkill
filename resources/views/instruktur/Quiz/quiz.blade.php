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

                                        @if ($quiz->isNotEmpty())
                                            @foreach ($quiz as $item)
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="dashboard__quiz-info">
                                                                <p>{{ $item->created_at->format('d F, Y') }}</p>
                                                                <h6 class="title">{{ $item->judul_tugas }}</h6>
                                                                <p style="font-size: 12px;">
                                                                    Waktu:
                                                                    {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H.i') }}
                                                                    s/d
                                                                    {{ \Carbon\Carbon::parse($item->jam_akhir)->format('H.i') }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="color-black">{{ $item->KelasTatapMuka->nama_kursus }}
                                                            </p>
                                                        </td>
                                                        <td id="quiz-status-{{ $item->id }}">
                                                            <span class="dashboard__quiz-result">Berjalan</span>
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
                                                </tbody>
                                            @endforeach
                                        @else
                                            <p>Data quiz tidak tersedia.</p>
                                        @endif



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
        function checkQuizStatus() {
            @foreach ($quiz as $quiz)
                $.get("{{ route('quiz.checkStatus', ['id' => $quiz->id]) }}", function(data) {
                    const statusElement = $("#quiz-status-{{ $quiz->id }}");
                    if (data.status === 'Selesai') {
                        statusElement.html('<span class="dashboard__quiz-result fail">Selesai</span>');
                    } else {
                        statusElement.html('<span class="dashboard__quiz-result">Berjalan</span>');
                    }
                });
            @endforeach
        }

        // Cek status setiap 60 detik (60000 ms)
        setInterval(checkQuizStatus, 60000);

        // Pengecekan awal saat halaman pertama kali dimuat
        $(document).ready(function() {
            checkQuizStatus();
        });
    </script>


@endsection
