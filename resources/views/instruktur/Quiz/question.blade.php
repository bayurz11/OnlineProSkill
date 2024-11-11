@section('title', 'ProSkill Akademia | Tambah Pertanyaan Pilihan Ganda')
<?php $page = 'instruktur.quiz'; ?>

@extends('layout.mainlayout')
@include('instruktur.modal.quizModal')
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
                            <button class="btn btn-primary" onclick="addChoiceQuestion()">Tambah Pertanyaan</button>
                        </div>

                        <form id="questionsForm">
                            <div class="row" id="questionsList">
                                <!-- Formulir pertanyaan pilihan ganda akan muncul di sini -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- dashboard-area-end -->

@endsection

<script>
    let questionCount = 0; // Menyimpan jumlah pertanyaan yang sudah ditambahkan

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
                <div class="form-group">
                    <label for="option1_${questionCount}">Pilihan 1</label>
                    <input type="text" id="option1_${questionCount}" name="questions[${questionCount}][options][1]" class="form-control" placeholder="Masukkan pilihan pertama">
                </div>
                <div class="form-group">
                    <label for="option2_${questionCount}">Pilihan 2</label>
                    <input type="text" id="option2_${questionCount}" name="questions[${questionCount}][options][2]" class="form-control" placeholder="Masukkan pilihan kedua">
                </div>
                <div class="form-group">
                    <label for="option3_${questionCount}">Pilihan 3</label>
                    <input type="text" id="option3_${questionCount}" name="questions[${questionCount}][options][3]" class="form-control" placeholder="Masukkan pilihan ketiga">
                </div>
                <div class="form-group">
                    <label for="option4_${questionCount}">Pilihan 4</label>
                    <input type="text" id="option4_${questionCount}" name="questions[${questionCount}][options][4]" class="form-control" placeholder="Masukkan pilihan keempat">
                </div>
                <div class="form-group">
                    <label for="correct_answer_${questionCount}">Jawaban Benar</label>
                    <select id="correct_answer_${questionCount}" name="questions[${questionCount}][correct_answer]" class="form-control">
                        <option value="1">Pilihan 1</option>
                        <option value="2">Pilihan 2</option>
                        <option value="3">Pilihan 3</option>
                        <option value="4">Pilihan 4</option>
                    </select>
                </div>
            </div>
        `;
        // Menambahkan form baru ke dalam list
        document.getElementById('questionsList').insertAdjacentHTML('beforeend', questionForm);
    }
</script>
