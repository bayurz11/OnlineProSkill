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
                                                {{-- <th>Qus</th>
                                                <th>TM</th>
                                                <th>CA</th> --}}
                                                <th>Result</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        @if ($KelasTatapMuka->isEmpty())
                                            <div class="alert alert-warning" role="alert">
                                                Anda Belum Menambahkan kelas Apapun
                                            </div>
                                        @else
                                            @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                                @php
                                                    // Mengecek apakah course_id ada di model Kurikulum
                                                    $kurikulumExists = \App\Models\Kurikulum::where(
                                                        'course_id',
                                                        $kelas->id,
                                                    )->exists();
                                                    $averageRating = $kelas->reviews()->avg('rating');
                                                @endphp
                                                @if ($kurikulumExists)
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="dashboard__quiz-info">
                                                                    <p>January 20, 2024</p>
                                                                    <h6 class="title">{{ $kelas->nama_kursus }}
                                                                    </h6>
                                                                    {{-- <span>Student: <a href="#">John Due</a></span> --}}
                                                                </div>
                                                            </td>
                                                            {{-- <td>
                                                                <p class="color-black">4</p>
                                                            </td>
                                                            <td>
                                                                <p class="color-black">8</p>
                                                            </td>
                                                            <td>
                                                                <p class="color-black">4</p>
                                                            </td> --}}
                                                            <td>
                                                                <span class="dashboard__quiz-result ">Pass</span>
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
                                                @endif
                                            @endforeach
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