@section('title', 'ProSkill Akademia | Tambah Pertanyaan Pilihan Ganda')
<?php $page = 'view_pg'; ?>

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
            @include('studen.nav.profile')

            <div class="row">
                @include('studen.nav.nav')
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

                                <!-- Tampilkan waktu pengerjaan -->
                                <dt class="col-sm-3">Waktu Pengerjaan</dt>
                                <dd class="col-sm-9">: <span id="countdown-timer">{{ $tugas->waktu_pengerjaan_jam }} Jam
                                        {{ $tugas->waktu_pengerjaan_menit }} Menit</span></dd>

                            </dl>
                        </div>

                        <!-- Question and Answer Section -->
                        <div class="row mt-4">
                            <div class="col-lg-8" id="question-container">
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
                                                        <input type="radio" name="answer_{{ $currentQuestion->id }}"
                                                            value="{{ $option->id }}" class="me-2"
                                                            onchange="handleAnswerChange('{{ $tugas->id_tugas }}', '{{ $currentQuestion->id }}', '{{ auth()->user()->id }}', this.value)" />

                                                        <span class="option-label">
                                                            {{ chr(65 + $index) }}. {{ $option->isi_pilihan }}
                                                        </span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Tombol simpan, tersembunyi sampai ada pilihan -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button id="save-button" class="btn btn-primary" style="display: none;"
                                                onclick="saveAnswer()">Simpan</button>
                                        </div>
                                    </div>

                                    <script>
                                        // Fungsi untuk menangani perubahan pilihan jawaban
                                        function handleAnswerChange(id_tugas, question_id, user_id, answer_value) {
                                            // Tampilkan tombol simpan saat ada pilihan
                                            document.getElementById('save-button').style.display = 'inline-block';

                                            // Simpan jawaban sementara jika diperlukan
                                            saveAnswer(id_tugas, question_id, user_id, answer_value);
                                        }

                                        // Fungsi untuk menyimpan jawaban
                                        function saveAnswer(id_tugas, question_id, user_id, answer_value) {
                                            // Logika penyimpanan jawaban
                                            console.log(
                                                `Menyimpan jawaban: tugas ${id_tugas}, soal ${question_id}, pengguna ${user_id}, pilihan ${answer_value}`
                                            );
                                            // Kamu bisa menambahkan AJAX untuk menyimpan jawaban di server
                                        }
                                    </script>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card ">
                                    <div class="card-header">
                                        <strong>Navigasi Soal</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="d-flex justify-content flex-wrap gap-3 px-3">
                                            @foreach ($allQuestions as $index => $question)
                                                <a href="{{ route('view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => $index + 1]) }}"
                                                    class="btn btn-sm rounded {{ $currentQuestionNumber == $index + 1 ? 'text-white' : 'text-dark' }}"
                                                    style="background-color: {{ $currentQuestionNumber == $index + 1 ? '#319A58' : '#E0E0E0' }}; 
                                                          margin-top: 8px; margin-bottom: 8px; box-shadow: none;">
                                                    {{ $index + 1 }}
                                                </a>
                                            @endforeach
                                        </div>

                                    </div>

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
        function loadQuestion(id_tugas, questionNumber) {
            $.ajax({
                url: `/tugas/${id_tugas}/question/${questionNumber}`,
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Update the question container with new data
                    const questionContent = `
                        <div class="card">
                            <div class="card-header">
                                <strong>Soal No. ${data.currentQuestionNumber}</strong>
                            </div>
                            <div class="card-body">
                                <p>${data.currentQuestion.isi_pertanyaan}</p>
                                <ul class="list-unstyled">
                                    ${data.options.map((option, index) => `
                                                                <li>
                                                                    <label>
                                                                        <span class="option-label">${String.fromCharCode(65 + index)}. ${option.isi_pilihan}</span>
                                                                    </label>
                                                                </li>
                                                            `).join('')}
                                </ul>
                            </div>
                        </div>
                    `;
                    $('#question-container').html(questionContent);
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat soal.');
                }
            });
        }

        // Ambil waktu pengerjaan dari PHP (jam dan menit)
        let waktuJam = {{ $tugas->waktu_pengerjaan_jam }};
        let waktuMenit = {{ $tugas->waktu_pengerjaan_menit }};
        let totalDetik = (waktuJam * 60 * 60) + (waktuMenit * 60);

        // Cek waktu tersisa dari localStorage jika ada
        const waktuTersisa = localStorage.getItem('waktuTersisa');
        if (waktuTersisa) {
            totalDetik = parseInt(waktuTersisa); // Gunakan waktu yang tersisa
        }

        // Fungsi untuk memperbarui tampilan hitungan mundur
        function updateCountdown() {
            if (totalDetik <= 0) {
                clearInterval(countdownInterval); // Hentikan interval jika waktu habis
                document.getElementById('countdown-timer').textContent = "Waktu habis!";
                return;
            }

            // Hitung jam, menit, detik
            let jam = Math.floor(totalDetik / 3600);
            let menit = Math.floor((totalDetik % 3600) / 60);
            let detik = totalDetik % 60;

            // Perbarui tampilan hitungan mundur
            const countdownText = `${jam} Jam ${menit} Menit ${detik} Detik`;
            const countdownTimer = document.getElementById('countdown-timer');
            countdownTimer.textContent = countdownText;

            // Periksa apakah waktu tersisa 5 menit atau kurang
            countdownTimer.style.color = totalDetik <= 5 * 60 ? 'red' : '';

            // Simpan waktu tersisa hanya saat ada perubahan
            if (totalDetik !== parseInt(localStorage.getItem('waktuTersisa'))) {
                localStorage.setItem('waktuTersisa', totalDetik);
            }

            // Kurangi waktu satu detik
            totalDetik--;
        }

        // Mulai hitungan mundur
        const countdownInterval = setInterval(updateCountdown, 1000);
    </script>


@endsection
