@section('title', 'ProSkill Akademia | Quiz Setting')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quiz Setting</li>
            </ol>
        </nav>
        @include('admin.modal.edit_siswa')
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Quiz</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#confirmationModalQuestion"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Quiz
                        </button>
                        <p class="text-muted mb-3"> Jumlah Quiz : {{ $quiz->count() }}</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Quiz</th>
                                        <th>Course Name</th>
                                        {{-- <th>TM</th>
                                        <th>CA</th> --}}
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($quiz as $quiz)
                                        <tr>
                                            <td>
                                                <div class="dashboard__quiz-info">
                                                    <p>{{ $quiz->created_at->format('d F, Y') }}</p>
                                                    <h6 class="title">{{ $quiz->judul_tugas }}</h6>
                                                    <p style="font-size: 12px;">
                                                        Tanggal:
                                                        {{ \Carbon\Carbon::parse($quiz->tanggal_mulai)->format('d F, Y') }}
                                                        s/d
                                                        {{ \Carbon\Carbon::parse($quiz->tanggal_akhir)->format('d F, Y') }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="color-black">{{ $quiz->KelasTatapMuka->nama_kursus }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    $tanggalAkhir = \Carbon\Carbon::parse(
                                                        $quiz->tanggal_akhir,
                                                    )->endOfDay();
                                                    $isSelesai = now()->greaterThan($tanggalAkhir);
                                                @endphp
                                                @if ($isSelesai)
                                                    <span class="dashboard__quiz-result fail">Selesai</span>
                                                @else
                                                    <span class="dashboard__quiz-result">Berjalan</span>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ route('admin_view_pg', $quiz->id_tugas) }}" title="Lihat Soal"
                                                    class="btn btn-success">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                <a href="#" title="Hapus Quiz" data-id="{{ $quiz->id_tugas }}"
                                                    class="btn btn-danger delete-quiz">
                                                    <i data-feather="trash"></i>
                                                </a>

                                                <form id="deleteQuizForm-{{ $quiz->id_tugas }}"
                                                    action="{{ route('adminquiz.destroy', $quiz->id_tugas) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <div class="modal fade" id="confirmationModalQuestion" tabindex="-1" aria-labelledby="confirmationModalQuestionlLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div style="background: white; padding: 40px; border-radius: 8px; text-align: center; position: relative;">
                    <h4>Pilih Jenis Pertanyaan</h4><br>
                    <p>Silakan pilih jenis pertanyaan yang ingin ditambahkan.</p><br>
                    <!-- Button menuju halaman pilihan ganda -->
                    <a href="{{ route('admin_question_pg') }}" class="btn btn-primary btn-lg">Pilihan Ganda</a>
                    <!-- Button menuju halaman esai -->
                    {{-- <a href="{{ route('instruktur_question_essay', ['id_tugas' => $quiz->id_tugas]) }}"
                        class="btn btn-secondary btn-lg">Esai</a> --}}
                    <!-- Tombol X di pojok kanan atas -->
                    <button onclick="hideModal()"
                        style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 24px; color: #333;">&times;</button>

                    <button onclick="hideModal()" class="btn btn-danger btn-lg"
                        style="background-color: #6c757d; border-color: #6c757d; color: white;">Batal</button>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus quiz ini?
                </div>
                <div class="modal-footer">
                    <button id="cancelDelete" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button id="confirmDelete" type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-quiz');
            let quizIdToDelete = null;

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Menyimpan ID quiz yang akan dihapus
                    quizIdToDelete = this.dataset.id;

                    // Menampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    modal.show();
                });
            });

            // Mengonfirmasi penghapusan setelah modal ditampilkan
            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (quizIdToDelete) {
                    const form = document.getElementById(`deleteQuizForm-${quizIdToDelete}`);
                    form.submit(); // Mengirimkan formulir untuk menghapus quiz
                }
            });
        });
    </script>



@endsection
