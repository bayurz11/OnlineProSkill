@section('title', 'ProSkill Akademia | Tambah Pertanyaan Pilihan Ganda')
<?php $page = 'instruktur_question_pg'; ?>

@extends('layout.mainlayout')
@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="public/assets/img/bg/breadcrumb_bg.jpg">
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

                        <form id="questionsForm">
                            <div class="row" id="questionsList">
                                <!-- Formulir pertanyaan pertama akan muncul saat halaman dimuat -->
                                <div class="col-12 question-form" id="question-form-1">
                                    <div class="form-group">
                                        <label for="question_1">Pertanyaan Pilihan Ganda 1</label>
                                        <textarea id="question_1" name="questions[1][question]" class="form-control" rows="2"
                                            placeholder="Tulis pertanyaan di sini..."></textarea>
                                    </div>

                                    <!-- Grid untuk pilihan jawaban A, B, C, D, E -->
                                    <div class="form-group">
                                        <div class="choices-grid">
                                            <div class="choice">
                                                <label for="optionA_1">Pilihan A</label>
                                                <input type="text" id="optionA_1" name="questions[1][options][A]"
                                                    class="form-control" placeholder="Masukkan pilihan A">
                                            </div>
                                            <div class="choice">
                                                <label for="optionD_1">Pilihan D</label>
                                                <input type="text" id="optionD_1" name="questions[1][options][D]"
                                                    class="form-control" placeholder="Masukkan pilihan D">
                                            </div>
                                            <div class="choice">
                                                <label for="optionB_1">Pilihan B</label>
                                                <input type="text" id="optionB_1" name="questions[1][options][B]"
                                                    class="form-control" placeholder="Masukkan pilihan B">
                                            </div>
                                            <div class="choice">
                                                <label for="optionE_1">Pilihan E</label>
                                                <input type="text" id="optionE_1" name="questions[1][options][E]"
                                                    class="form-control" placeholder="Masukkan pilihan E">
                                            </div>

                                            <div class="choice">
                                                <label for="optionC_1">Pilihan C</label>
                                                <input type="text" id="optionC_1" name="questions[1][options][C]"
                                                    class="form-control" placeholder="Masukkan pilihan C">
                                            </div>
                                            <div class="choice">
                                                <label for="correct_answer_1">Jawaban Benar</label>
                                                <select id="correct_answer_1" name="questions[1][correct_answer]"
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
                                                <label for="optionA_1">Pilihan A</label>
                                                <input type="text" id="optionA_1" name="questions[1][options][A]"
                                                    class="form-control" placeholder="Masukkan pilihan A">
                                            </div>
                                            <div class="choice">
                                                <label for="optionD_1">Pilihan D</label>
                                                <input type="text" id="optionD_1" name="questions[1][options][D]"
                                                    class="form-control" placeholder="Masukkan pilihan D">
                                            </div>
                                            <div class="choice">
                                                <label for="optionB_1">Pilihan B</label>
                                                <input type="text" id="optionB_1" name="questions[1][options][B]"
                                                    class="form-control" placeholder="Masukkan pilihan B">
                                            </div>
                                            <div class="choice">
                                                <label for="optionE_1">Pilihan E</label>
                                                <input type="text" id="optionE_1" name="questions[1][options][E]"
                                                    class="form-control" placeholder="Masukkan pilihan E">
                                            </div>

                                            <div class="choice">
                                                <label for="optionC_1">Pilihan C</label>
                                                <input type="text" id="optionC_1" name="questions[1][options][C]"
                                                    class="form-control" placeholder="Masukkan pilihan C">
                                            </div>
                                            <div class="choice">
                                                <label for="correct_answer_1">Jawaban Benar</label>
                                                <select id="correct_answer_1" name="questions[1][correct_answer]"
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
