@section('title', 'ProSkill Akademia | Tambah Pertanyaan Pilihan Ganda')
<?php $page = 'instruktur_view_pg'; ?>

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
                                            @foreach ($currentQuestion->pilihanJawaban as $index => $option)
                                                <li>
                                                    <label>
                                                        <span class="option-label">
                                                            {{ chr(65 + $index) }}. {{ $option->isi_pilihan }}
                                                        </span>
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
                                                        <td>
                                                            @foreach ($question->pilihanJawaban as $i => $option)
                                                                @if ($option->benar)
                                                                    <span>{{ chr(65 + $i) }}. {{ $option->isi_pilihan }}
                                                                    </span><br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="text-primary px-2 fs-4">
                                            &laquo;&laquo;
                                        </a>
                                        <span>1 / 1 </span>
                                        <a href="#" class="text-primary px-2 fs-4">
                                            &raquo;&raquo;
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="mt-4 text-center">
                            <a href="#" class="text-primary px-2 fs-4">
                                &laquo;&laquo;
                            </a>
                            <span>1 Dari {{ $totalQuestions }} Nomor Soal</span>
                            <a href="#" class="text-primary px-2 fs-4">
                                &raquo;&raquo;
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>Nilai Siswa</strong>
                            <div>
                                <a href="#" class="text-decoration-none text-white px-3 py-1 rounded me-2"
                                    style="background-color: #007bff;">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                                <a href="#" class="text-decoration-none text-white px-3 py-1 rounded"
                                    style="background-color: #28a745;">
                                    <i class="fas fa-file-excel"></i> Ekspor Excel
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Benar</th>
                                        <th>Salah</th>
                                        <th>Tidak Dijawab</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->nama }}</td>
                                            <td>{{ $student->benar ?? 'Belum Mengerjakan Ujian' }}</td>
                                            <td>{{ $student->salah ?? 'Belum Mengerjakan Ujian' }}</td>
                                            <td>{{ $student->tidak_dijawab ?? 'Belum Mengerjakan Ujian' }}</td>
                                            <td>
                                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->
@endsection
