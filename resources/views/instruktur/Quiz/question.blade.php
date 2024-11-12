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
                            <h4 class="title">Pertanyaan Pilihan Ganda</h4>
                        </div>

                        <form id="questionsForm" action="{{ route('instruktur_pertanyaan_pg.store') }}" method="POST">
                            @csrf
                            <div class="row" id="questionsList">
                                @foreach ($pertanyaan as $index => $question)
                                    <div class="col-12 question-form" id="question-form-{{ $index + 1 }}">
                                        <div class="form-group">
                                            <label for="question_{{ $index + 1 }}">Pertanyaan {{ $index + 1 }}</label>
                                            <textarea class="form-control" rows="2" readonly>{{ $question->isi_pertanyaan }}</textarea>
                                        </div>
                                        <div class="form-group choices-grid">
                                            @foreach ($question->pilihanJawaban as $optionKey => $option)
                                                <div class="choice">
                                                    <label>Pilihan {{ chr(65 + $optionKey) }}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $option->isi_pilihan }}" readonly>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
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
