@section('title', 'ProSkill Akademia | Veiw Quiz')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Quiz</li>
            </ol>
        </nav>

        @include('admin.modal.edit_siswa')

        <div class="row">
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

                            <dt class="col-sm-3">Jumlah Siswa</dt>
                            <dd class="col-sm-9">: {{ $daftarpesanan[0]->jumlah_order_paid ?? 0 }} Siswa</dd>
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
                                                <tr
                                                    class="{{ $currentQuestionNumber == $index + 1 ? 'table-primary' : '' }} ">
                                                    <td>
                                                        <a href="{{ route('instruktur_view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => $index + 1]) }}"
                                                            class="text-decoration-none {{ $currentQuestionNumber == $index + 1 ? 'fw-bold text-dark' : 'text-primary' }}">
                                                            {{ $index + 1 }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @foreach ($question->pilihanJawaban as $i => $option)
                                                            @if ($option->benar)
                                                                <span>{{ chr(65 + $i) }}</span><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer text-center">
                                    <a href="{{ route('instruktur_view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => max($currentQuestionNumber - 1, 1)]) }}"
                                        class="text-primary px-2 fs-4">
                                        &laquo;
                                    </a>
                                    <span>No {{ $currentQuestionNumber }} / {{ $totalQuestions }} </span>
                                    <a href="{{ route('instruktur_view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => min($currentQuestionNumber + 1, $totalQuestions)]) }}"
                                        class="text-primary px-2 fs-4">
                                        &raquo;
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    @if ($totalQuestions > 1)
                        <div class="mt-4 text-center">
                            <a href="{{ route('instruktur_view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => max($currentQuestionNumber - 1, 1)]) }}"
                                class="text-primary px-2 fs-4">
                                &laquo;&laquo;
                            </a>
                            <span>No {{ $currentQuestionNumber }} Dari {{ $totalQuestions }} Soal</span>
                            <a href="{{ route('instruktur_view_pg', ['id_tugas' => $tugas->id_tugas, 'current_question_number' => min($currentQuestionNumber + 1, $totalQuestions)]) }}"
                                class="text-primary px-2 fs-4">
                                &raquo;&raquo;
                            </a>
                        </div>
                    @endif


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
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Add students' grades here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

                    // Perbarui konten div
                    $('#question-container').html(`
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
                                                                                                                                                                <span class="option-label">
                                                                                                                                                                    ${String.fromCharCode(65 + index)}. ${option.isi_pilihan}
                                                                                                                                                                </span>
                                                                                                                                                            </label>
                                                                                                                                                        </li>
                                                                                                                                                    `).join('')}
                                </ul>
                            </div>
                        </div>
                    `);
                },
                error: function(err) {
                    alert('Terjadi kesalahan saat memuat soal.');
                }
            });
        }

        // Contoh penggunaan: loadQuestion(1, 2);
    </script>
@endsection
