@section('title', 'ProSkill Akademia | Tambah Pertanyaan Pilihan Ganda')
<?php $page = 'instruktur_question_pg'; ?>

@extends('layout.mainlayout')
@section('content')

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
                    <!-- Combined Form to Add New Quiz and Questions -->
                    <div class="dashboard__content-wrap">
                        <!-- Title and Details Section -->
                        <div class="dashboard__content-title">
                            <h4 class="fw-bold mb-3">{{ $tugas->judul_tugas }}</h4>
                            <dl class="row">
                                <dt class="col-sm-3">Kelas</dt>
                                <dd class="col-sm-9">: {{ $tugas->KelasTatapMuka->nama_kursus }}</dd>

                                <dt class="col-sm-3">Jumlah Soal</dt>
                                <dd class="col-sm-9">: {{ $tugas->pertanyaan->count() }}</dd>

                                <dt class="col-sm-3">Waktu Pengerjaan</dt>
                                <dd class="col-sm-9">: {{ $tugas->waktu_pengerjaan_jam }} Jam
                                    {{ $tugas->waktu_pengerjaan_menit }} Menit</dd>
                            </dl>
                        </div>

                        <!-- Question and Answer Section -->
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <!-- Question Card -->
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Soal No. {{ $currentQuestionNumber }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $currentQuestion->isi_pertanyaan }}</p>
                                        <ul class="list-unstyled">
                                            @foreach ($currentQuestion->pilihanJawaban as $option)
                                                <li>
                                                    <label>
                                                        <input type="radio" name="answer" value="{{ $option->id }}">
                                                        {{ $option->isi_pilihan }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Answer Summary Card -->
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Jawaban</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No. Soal</th>
                                                    <th>Jawaban</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allQuestions as $index => $question)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $question->benar }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-sm btn-primary">Sebelumnya</button>
                                        <button class="btn btn-sm btn-primary">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="mt-4 text-center">
                            <button class="btn btn-success">Back</button>
                            <span>1 Dari {{ $totalQuestions }} Nomor Soal</span>
                            <button class="btn btn-success">Next</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->
@endsection
