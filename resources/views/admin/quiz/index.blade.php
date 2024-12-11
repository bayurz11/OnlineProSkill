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
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Quiz
                        </button>
                        {{-- <p class="text-muted mb-3"> Jumlah Produk : {{ $course->count() }}</p> --}}
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Quiz</th>
                                        <th>Course Name</th>
                                        {{-- <th>TM</th>
                                        <th>CA</th> --}}
                                        <th>Keterangan</th>
                                        <th>&nbsp;</th>
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
                                                <div class="dashboard__review-action">
                                                    <a href="{{ route('instruktur_view_pg', $quiz->id_tugas) }}"
                                                        title="Lihat Soal">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" title="Hapus Quiz" data-id="{{ $quiz->id_tugas }}"
                                                        class="delete-quiz">
                                                        <i class="skillgro-bin"></i>
                                                    </a>
                                                </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formSwitches = document.querySelectorAll('.formSwitch');

            formSwitches.forEach(function(formSwitch) {
                // Set initial state of the switch based on the status
                formSwitch.checked = formSwitch.dataset.status == 1;

                formSwitch.addEventListener('change', function() {
                    const UserId = formSwitch.dataset.id;
                    const newStatus = formSwitch.checked ? 1 : 0;

                    fetch('/update-daftar_siswa/' + UserId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                formSwitch.dataset.status = newStatus;
                            } else {
                                alert('Gagal mengupdate status');
                            }
                        })
                        .catch(() => {
                            alert('Terjadi kesalahan');
                        });
                });
            });
        });
    </script>

@endsection
