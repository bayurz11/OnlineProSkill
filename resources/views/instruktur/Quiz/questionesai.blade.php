@section('title', 'ProSkill Akademia | Tambah Pertanyaan Esai')
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
                            <h4 class="title">Pertanyaan</h4>
                            <button class="btn btn-primary" onclick="addQuestionForm()">Tambah Pertanyaan</button>
                        </div>

                        <form id="questionsForm">
                            <div class="row" id="questionsList">
                                <!-- Formulir pertanyaan akan muncul di sini -->
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
    let questionCount = 0; // Menyimpan jumlah pertanyaan

    function addQuestionForm() {
        questionCount++; // Menambah nomor urut
        const questionForm = `
            <div class="col-12 question-form" id="question-form-${questionCount}">
                <div class="form-group">
                    <label for="question_${questionCount}">Pertanyaan Esai ${questionCount}</label>
                    <textarea id="question_${questionCount}" name="questions[${questionCount}][question]" class="form-control" rows="4" placeholder="Tulis pertanyaan esai di sini..."></textarea>
                </div>
                <div class="form-group">
                    <label for="answer_${questionCount}">Jawaban Esai ${questionCount}</label>
                    <textarea id="answer_${questionCount}" name="questions[${questionCount}][answer]" class="form-control" rows="4" placeholder="Tulis jawaban esai di sini..."></textarea>
                </div>
            </div>
        `;
        document.getElementById('questionsList').insertAdjacentHTML('beforeend', questionForm);
    }
</script>