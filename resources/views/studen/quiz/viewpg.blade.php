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
                                            <i class="fas fa-clock text-success me-2" id="timer-icon"></i>
                                            <span id="timer-text" class="timer-text text-success">00:00</span>
                                        </div>



                                    </div>


                                    <div class="card-body">
                                        @if ($currentQuestion)
                                            <p>{{ $currentQuestion->isi_pertanyaan }}</p>
                                            <ul class="list-unstyled">
                                                @foreach ($currentQuestion->pilihanJawaban as $index => $option)
                                                    <li>
                                                        <label for="option_{{ $option->id_pilihan }}">
                                                            <input type="radio" name="answer_{{ $currentQuestion->id }}"
                                                                value="{{ $option->id_pilihan }}" class="me-2"
                                                                onchange="handleAnswerChange('{{ $tugas->id_tugas }}', '{{ $currentQuestion->id_pertanyaan }}', '{{ auth()->user()->id }}', '{{ $option->id_pilihan }}', this.value, '')"
                                                                @if ($currentQuestion->jawaban->first() && $currentQuestion->jawaban->first()->id_pilihan == $option->id_pilihan) checked @endif />
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
                    if (!data.currentQuestion) {
                        alert('Soal tidak ditemukan.');
                        return;
                    }

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
                                                                            </li>`).join('')}
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
        let totalSeconds = (waktuJam * 3600) + (waktuMenit * 60);

        // Cek apakah waktu tersisa ada di LocalStorage
        const storedTime = localStorage.getItem('waktuTersisa');
        if (storedTime) {
            totalSeconds = parseInt(storedTime);
        }

        function updateTimer() {
            const timerText = document.getElementById('timer-text');
            const timerIcon = document.getElementById('timer-icon');

            if (totalSeconds <= 0) {
                clearInterval(timerInterval);
                timerText.textContent = 'Waktu habis!';
                timerText.style.color = 'red';
                timerIcon.style.color = 'red';

                // Disable semua pilihan
                document.querySelectorAll('input[type="radio"]').forEach(input => input.disabled = true);
                return;
            }

            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerText.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            // Ubah warna jika kurang dari 5 menit
            if (totalSeconds <= 300) {
                timerText.style.color = 'red';
                timerIcon.style.color = 'red';
            }

            localStorage.setItem('waktuTersisa', totalSeconds);
            totalSeconds--;
        }

        const timerInterval = setInterval(updateTimer, 1000);

        function finishQuiz() {
            $.ajax({
                url: `/tugas/{{ $tugas->id_tugas }}/finish`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: '{{ auth()->user()->id }}'
                },
                success: function(response) {
                    // Tampilkan modal dengan nilai yang didapat
                    $('#quizResultModal .modal-body').html(`
                <h4 class="text-center">Nilai Anda</h4>
                <p class="text-center display-4 text-success">${response.score}</p>
            `);
                    $('#quizResultModal').modal('show');
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message || 'Terjadi kesalahan saat menyelesaikan quiz.');
                }
            });
        }

        // Event handler untuk tombol "Tutup Quiz" untuk mengarahkan ke route /quiz
        $('#closeQuizButton').on('click', function() {
            window.location.href = '{{ route('quiz') }}'; // Arahkan ke halaman quiz
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="quizResultModal" tabindex="-1" aria-labelledby="quizResultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quizResultModalLabel">Hasil Quiz</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body text-center">
                    <!-- Konten nilai akan diisi secara dinamis -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeQuizButton" data-bs-dismiss="modal">Tutup
                        Quiz</button>
                </div>
            </div>
        </div>
    </div>


@endsection
