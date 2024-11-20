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

                                <dt class="col-sm-3">Waktu Pengerjaan</dt>
                                <dd class="col-sm-9">: {{ $tugas->waktu_pengerjaan_jam }} Jam
                                    {{ $tugas->waktu_pengerjaan_menit }} Menit</dd>

                            </dl>
                        </div>

                        <!-- Question and Answer Section -->
                        <div class="row mt-4">
                            <div class="col-lg-8" id="question-container">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        @if ($currentQuestion)
                                            <strong>Soal No. {{ $currentQuestionNumber }}</strong>
                                        @else
                                            <strong>Quiz Selesai</strong>
                                        @endif
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock mr-3 text-primary"></i>
                                            <span id="countdown-timer" class="ml-2"></span>
                                        </div>
                                    </div>


                                    <div class="card-body">
                                        @if ($currentQuestion)
                                            <p>{{ $currentQuestion->isi_pertanyaan }}</p>
                                            <ul class="list-unstyled">
                                                @foreach ($currentQuestion->pilihanJawaban as $index => $option)
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="answer_{{ $currentQuestion->id }}"
                                                                value="{{ $option->id }}" class="me-2"
                                                                onchange="handleAnswerChange('{{ $tugas->id_tugas }}', '{{ $currentQuestion->id_pertanyaan }}', '{{ auth()->user()->id }}', '{{ $option->id_pilihan }}', this.value, '')"
                                                                @if ($currentQuestion->jawaban->first() && $currentQuestion->jawaban->first()->pilihan_id == $option->id) checked @endif />
                                                            <span class="option-label">{{ chr(65 + $index) }}.
                                                                {{ $option->isi_pilihan }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Quiz telah selesai. Terima kasih telah berpartisipasi!</p>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button class="btn btn-success" onclick="finishQuiz()">Akhiri Quiz</button>
                                            </div>
                                        @endif
                                        <!-- Tombol Simpan -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button id="save-button" class="btn btn-primary mt-3" style="display: none;">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Navigasi Soal</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="d-flex justify-content flex-wrap gap-3 px-3">
                                            @foreach ($allQuestions as $index => $question)
                                                <a href="{{ route('view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => $index + 1]) }}"
                                                    class="btn btn-sm rounded {{ $currentQuestionNumber == $index + 1 ? 'text-white border-2 border-success' : 'text-dark' }}"
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

                    // Buat ulang HTML untuk pertanyaan
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
                                                                                                                                                            <input type="radio" name="answer_${data.currentQuestion.id}"
                                                                                                                                                                value="${option.id_pilihan}" class="me-2"
                                                                                                                                                                onchange="handleAnswerChange('${id_tugas}', '${data.currentQuestion.id_pertanyaan}', '${option.id_pilihan}')">
                                                                                                                                                            <span class="option-label">${String.fromCharCode(65 + index)}. ${option.isi_pilihan}</span>
                                                                                                                                                        </label>
                                                                                                                                                    </li>
                                                                                                                                                `).join('')}
                        </ul>
                    </div>
                </div>
            `;

                    // Update container soal
                    $('#question-container').html(questionContent);
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat soal.');
                }
            });
        }


        // Fungsi untuk menangani perubahan pilihan jawaban
        function handleAnswerChange(id_tugas, question_id, user_id, answer_value) {

            // Tampilkan tombol simpan saat ada pilihan
            document.getElementById('save-button').style.display = 'inline-block';

            // Simpan jawaban menggunakan AJAX
            saveAnswer(id_tugas, question_id, user_id, answer_value);
        }

        // Fungsi untuk menyimpan jawaban
        function saveAnswer(id_tugas, question_id, user_id, answer_value) {

            // Persiapkan data yang akan dikirim
            let data = {
                _token: '{{ csrf_token() }}', // Sertakan CSRF token
                id_pertanyaan: question_id,
                id_pilihan: answer_value, // ID pilihan jawaban
            };

            console.log("Data yang dikirim: ", data); // Debugging

            // Kirim data ke backend menggunakan AJAX

            $.ajax({
                url: `/tugas/${id_tugas}/jawaban`,
                method: 'POST',
                data: data,
                success: function(response) {
                    // // Sembunyikan tombol setelah disimpan
                    // document.getElementById('save-button').style.display = 'none';

                    // Setelah berhasil disimpan, pindahkan ke soal berikutnya
                    const nextQuestionNumber = {{ $currentQuestionNumber }} +
                        1; // Menambah 1 untuk soal berikutnya
                    window.location.href =
                        `{{ route('view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => '']) }}` +
                        nextQuestionNumber;
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message || 'Terjadi kesalahan saat mengirim jawaban.');
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

                // Nonaktifkan semua input radio
                const radioButtons = document.querySelectorAll('input[type="radio"]');
                radioButtons.forEach((radio) => {
                    radio.disabled = true; // Tambahkan atribut disabled
                });

                return;
            }

            // Hitung jam, menit, detik
            let jam = Math.floor(totalDetik / 3600);
            let menit = Math.floor((totalDetik % 3600) / 60);
            let detik = totalDetik % 60;

            // Perbarui tampilan hitungan mundur
            const countdownText = `${jam} : ${menit} : ${detik}`;
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
