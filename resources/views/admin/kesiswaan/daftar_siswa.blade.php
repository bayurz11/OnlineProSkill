@section('title', 'ProSkill Akademia | Daftar Siswa')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Siswa</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Daftar Siswa</h6>

                        <p class="text-muted mb-3"> Jumlah Siswa : </p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($course as $key => $courses)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $courses->nama_kursus }}</td>
                                            <td>{{ $courses->user->name }}</td>
                                            <td>
                                                @if ($courses->free)
                                                    Free
                                                @elseif(!empty($courses->discount) && !empty($courses->discountedPrice))
                                                    Rp. {{ number_format($courses->discountedPrice, 0, ',', '.') }}
                                                @else
                                                    Rp. {{ number_format($courses->price, 0, ',', '.') }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="form-check form-switch mb-2">
                                                    <input type="checkbox" class="form-check-input formSwitch"
                                                        id="formSwitch{{ $courses->id }}" data-id="{{ $courses->id }}"
                                                        data-status="{{ $courses->status }}">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('kurikulum', ['id' => $courses->id]) }}"
                                                    class="btn btn-success btn-icon kurikulum-btn"
                                                    data-id="{{ $courses->id }}" title="Kurikulum">
                                                    <i data-feather="settings"></i>
                                                </a>


                                                <button type="button" class="btn btn-primary btn-icon edit-button"
                                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $courses->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>

                                                <button onclick="hapus('{{ $courses->id }}')"
                                                    class="btn btn-danger btn-icon" title="Hapus">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
