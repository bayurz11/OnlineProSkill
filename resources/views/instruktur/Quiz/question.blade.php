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

    <script>
        let questionCount = 1;

        function addChoiceQuestion() {
            questionCount++;

            // Mengambil elemen question-form yang pertama sebagai template
            const questionFormTemplate = document.querySelector('.question-form').cloneNode(true);
            questionFormTemplate.id = `question-form-${questionCount}`;

            // Mengubah teks label dan atribut id untuk elemen-elemen yang baru
            const labels = questionFormTemplate.querySelectorAll('label');
            const inputs = questionFormTemplate.querySelectorAll('input, textarea, select');

            labels.forEach(label => {
                if (label.getAttribute('for').includes('question_')) {
                    label.setAttribute('for', `question_${questionCount}`);
                    label.textContent = `Pertanyaan Pilihan Ganda ${questionCount}`;
                }
                if (label.getAttribute('for').includes('optionA_')) {
                    label.setAttribute('for', `optionA_${questionCount}`);
                }
                if (label.getAttribute('for').includes('optionB_')) {
                    label.setAttribute('for', `optionB_${questionCount}`);
                }
                if (label.getAttribute('for').includes('optionC_')) {
                    label.setAttribute('for', `optionC_${questionCount}`);
                }
                if (label.getAttribute('for').includes('optionD_')) {
                    label.setAttribute('for', `optionD_${questionCount}`);
                }
                if (label.getAttribute('for').includes('optionE_')) {
                    label.setAttribute('for', `optionE_${questionCount}`);
                }
                if (label.getAttribute('for').includes('correct_answer_')) {
                    label.setAttribute('for', `correct_answer_${questionCount}`);
                }
            });

            inputs.forEach(input => {
                if (input.id.includes('question_')) {
                    input.id = `question_${questionCount}`;
                    input.name = `questions[${questionCount}][question]`;
                    input.value = '';
                }
                if (input.id.includes('optionA_')) {
                    input.id = `optionA_${questionCount}`;
                    input.name = `questions[${questionCount}][options][A]`;
                    input.value = '';
                }
                if (input.id.includes('optionB_')) {
                    input.id = `optionB_${questionCount}`;
                    input.name = `questions[${questionCount}][options][B]`;
                    input.value = '';
                }
                if (input.id.includes('optionC_')) {
                    input.id = `optionC_${questionCount}`;
                    input.name = `questions[${questionCount}][options][C]`;
                    input.value = '';
                }
                if (input.id.includes('optionD_')) {
                    input.id = `optionD_${questionCount}`;
                    input.name = `questions[${questionCount}][options][D]`;
                    input.value = '';
                }
                if (input.id.includes('optionE_')) {
                    input.id = `optionE_${questionCount}`;
                    input.name = `questions[${questionCount}][options][E]`;
                    input.value = '';
                }
                if (input.id.includes('correct_answer_')) {
                    input.id = `correct_answer_${questionCount}`;
                    input.name = `questions[${questionCount}][correct_answer]`;
                    input.value = '';
                }
            });

            // Menambahkan elemen baru ke dalam questionsList
            document.getElementById('questionsList').appendChild(questionFormTemplate);
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
