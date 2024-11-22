@section('title', 'ProSkill Akademia | Quiz')
<?php $page = 'quiz'; ?>

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
            @include('studen.nav.profile')

            <div class="row">
                @include('studen.nav.nav')
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">

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
                                                            <p style="font-size: 12px;">Waktu Pengerjaan:
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
                                                            @if ($isSelesai)
                                                                <span class="dashboard__quiz-result fail">Selesai</span>
                                                            @else
                                                                <a href="{{ route('view_pg', $quiz->id_tugas) }}"
                                                                    title="Kerjakan Soal">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            @endif
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


@endsection
