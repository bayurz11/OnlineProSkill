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

                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title d-flex justify-content-between align-items-center">
                            <h4 class="title">Tambah Quiz Baru</h4>
                        </div>

                        <form id="createKurikulumForm" action="{{ route('instruktur_quiz.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="QuizModalLabel">Tambah Quiz Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Hidden field for kurikulum_id -->
                                <input type="hidden" name="id_instruktur" id="id_instruktur"
                                    value="{{ Auth::user()->id }}">


                                <div class="mb-3">
                                    <label for="judul_tugas" class="form-label">Judul <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul_tugas" name="judul_tugas"
                                        placeholder="Masukkan Judul Quiz Anda" required>
                                </div>
                                <div class="mb-3">
                                    <label for="course_id" class="form-label">Pilih Course</label>
                                    <select class="form-control" id="course_id" name="course_id">
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        @foreach ($KelasTatapMuka->where('status', 1) as $kelas)
                                            @php
                                                // Mengecek apakah course_id ada di model Kurikulum
                                                $kurikulumExists = \App\Models\Kurikulum::where(
                                                    'course_id',
                                                    $kelas->id,
                                                )->exists();

                                            @endphp
                                            @if ($kurikulumExists)
                                                <option value="{{ $kelas->id }}">
                                                    {{ $kelas->nama_kursus }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 d-flex justify-content-between">
                                    <div class="me-2" style="flex: 1;">
                                        <label for="jam_mulai" class="form-label">Waktu Mulai</label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                            placeholder="Pilih waktu mulai">
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="jam_akhir" class="form-label">Waktu Selesai</label>
                                        <input type="time" class="form-control" id="jam_akhir" name="jam_akhir"
                                            placeholder="Pilih waktu selesai">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>

                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title d-flex justify-content-between align-items-center">
                            <h4 class="title">Pertanyaan Pilihan Ganda</h4>

                        </div>

                        <form id="questionsForm" action="{{ route('instruktur_pertanyaan_pg.store') }}" method="POST">
                            @csrf
                            <div class="row" id="questionsList">
                                <div class="col-12 question-form" id="question-form-1">
                                    <div class="form-group">
                                        <label for="question_1">Pertanyaan Pilihan Ganda 1</label>
                                        <textarea id="question_1" name="questions[1][question]" class="form-control" rows="2"
                                            placeholder="Tulis pertanyaan di sini..." required></textarea>
                                    </div>
                                    <input type="hidden" id="id_tugas_input" name="id_tugas" value="">

                                    <!-- Grid untuk pilihan jawaban A, B, C, D, E -->
                                    <div class="form-group">
                                        <div class="choices-grid">
                                            <div class="choice">
                                                <label for="optionA_1">Pilihan A</label>
                                                <input type="text" id="optionA_1" name="questions[1][options][A]"
                                                    class="form-control" placeholder="Masukkan pilihan A" required>
                                            </div>
                                            <div class="choice">
                                                <label for="optionD_1">Pilihan D</label>
                                                <input type="text" id="optionD_1" name="questions[1][options][D]"
                                                    class="form-control" placeholder="Masukkan pilihan D" required>
                                            </div>
                                            <div class="choice">
                                                <label for="optionB_1">Pilihan B</label>
                                                <input type="text" id="optionB_1" name="questions[1][options][B]"
                                                    class="form-control" placeholder="Masukkan pilihan B" required>
                                            </div>
                                            <div class="choice">
                                                <label for="optionE_1">Pilihan E</label>
                                                <input type="text" id="optionE_1" name="questions[1][options][E]"
                                                    class="form-control" placeholder="Masukkan pilihan E" required>
                                            </div>

                                            <div class="choice">
                                                <label for="optionC_1">Pilihan C</label>
                                                <input type="text" id="optionC_1" name="questions[1][options][C]"
                                                    class="form-control" placeholder="Masukkan pilihan C" required>
                                            </div>
                                            <div class="choice">
                                                <label for="correct_answer_1">Jawaban Benar</label>
                                                <select id="correct_answer_1" name="questions[1][correct_answer]"
                                                    class="form-control" required>
                                                    <option>Pilihan Jawaban</option>
                                                    <option value="A">Pilihan A</option>
                                                    <option value="B">Pilihan B</option>
                                                    <option value="C">Pilihan C</option>
                                                    <option value="D">Pilihan D</option>
                                                    <option value="E">Pilihan E</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                        <div class="form-group d-flex justify-content-end">

                            <button type="button" class="btn btn-primary" onclick="addChoiceQuestion()">Tambah
                                Pertanyaan</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection


<script>
    let questionCount = 1; // Inisialisasi nomor pertanyaan

    // Fungsi untuk menambah form pertanyaan pilihan ganda
    function addChoiceQuestion() {
        questionCount++; // Menambah nomor urut untuk pertanyaan

        // Membuat form pertanyaan pilihan ganda baru
        const questionForm = `
        <div class="col-12 question-form" id="question-form-${questionCount}">
            <div class="form-group">
                <label for="question_${questionCount}">Pertanyaan Pilihan Ganda ${questionCount}</label>
                <textarea id="question_${questionCount}" name="questions[${questionCount}][question]" class="form-control" rows="2" placeholder="Tulis pertanyaan di sini..."></textarea>
            </div>
            
            <!-- Grid untuk pilihan jawaban A, B, C, D, E -->
            <div class="form-group">
                <div class="choices-grid">
                    <div class="choice">
                        <label for="optionA_${questionCount}">Pilihan A</label>
                        <input type="text" id="optionA_${questionCount}" name="questions[${questionCount}][options][A]"
                            class="form-control" placeholder="Masukkan pilihan A">
                    </div>
                     <div class="choice">
                        <label for="optionD_${questionCount}">Pilihan D</label>
                        <input type="text" id="optionD_${questionCount}" name="questions[${questionCount}][options][D]"
                            class="form-control" placeholder="Masukkan pilihan D">
                    </div>
                    <div class="choice">
                        <label for="optionB_${questionCount}">Pilihan B</label>
                        <input type="text" id="optionB_${questionCount}" name="questions[${questionCount}][options][B]"
                            class="form-control" placeholder="Masukkan pilihan B">
                    </div>
                    <div class="choice">
                        <label for="optionE_${questionCount}">Pilihan E</label>
                        <input type="text" id="optionE_${questionCount}" name="questions[${questionCount}][options][E]"
                            class="form-control" placeholder="Masukkan pilihan E">
                    </div>
                    <div class="choice">
                        <label for="optionC_${questionCount}">Pilihan C</label>
                        <input type="text" id="optionC_${questionCount}" name="questions[${questionCount}][options][C]"
                            class="form-control" placeholder="Masukkan pilihan C">
                    </div>
                   
                    
                    <div class="choice">
                        <label for="correct_answer_${questionCount}">Jawaban Benar</label>
                        <select id="correct_answer_${questionCount}" name="questions[${questionCount}][correct_answer]"
                            class="form-control">
                            <option>Pilihan Jawaban</option>
                            <option value="A">Pilihan A</option>
                            <option value="B">Pilihan B</option>
                            <option value="C">Pilihan C</option>
                            <option value="D">Pilihan D</option>
                            <option value="E">Pilihan E</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    `;

        // Menambahkan form baru ke dalam list
        document.getElementById('questionsList').insertAdjacentHTML('beforeend', questionForm);
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Mendapatkan id_tugas dari URL
        const url = window.location.pathname;
        const id_tugas = url.split("/").pop(); // Mengambil bagian terakhir dari URL sebagai id_tugas

        // Set id_tugas ke dalam input hidden
        document.getElementById("id_tugas_input").value = id_tugas;
    });
</script>

<style>
    /* CSS Grid untuk memilih tata letak pilihan A, B, C, D, E */
    .choices-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Dua kolom untuk A-B dan C-D */
        gap: 15px;
        margin-bottom: 15px;
    }

    .choice {
        display: flex;
        flex-direction: column;
    }

    .choice input {
        margin-top: 5px;
    }

    /* Menambahkan jarak antar form pertanyaan */
    .question-form {
        margin-bottom: 30px;
        /* Menambah jarak bawah antar pertanyaan */
    }

    /* CSS Grid untuk memilih tata letak pilihan A, B, C, D, E */
    .choices-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .choice {
        display: flex;
        flex-direction: column;
    }

    .choice input {
        margin-top: 5px;
    }
</style>
