@section('title', 'ProSkill Akademia | Kurikulum')
<?php $page = 'Ofline_class'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('classroomsetting') }}">Kelas Tatap Muka</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kurikulum</li>
            </ol>
        </nav>

        @include('admin.modal.add_kurikulum')
        @include('admin.modal.add_materi')
        @include('admin.modal.edit_kurikulum')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kurikulum</h6>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#kurikulumModal" data-id="new">
                                <i class="btn-icon-prepend" data-feather="plus-circle"></i> Kurikulum
                            </button>


                        </div><br>
                        <p class="text-muted mb-3"> Jumlah Kurikulum : {{ $kurikulum->count() }}</p>
                        <div class="table-responsive">
                            @foreach ($kurikulum as $kurikulum)
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div>
                                                {{ $kurikulum->no_urut }}. {{ $kurikulum->title }}
                                            </div>
                                            <div class="d-flex gap-2"> <!-- Tambahkan div ini untuk menampung tombol -->
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-target="#exampleModalEdit" title="Edit Kurikulum">
                                                    <i class="btn-icon-prepend" data-feather="edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-target="#exampleModal" title="Hapus Kurikulum">
                                                    <i class="btn-icon-prepend" data-feather="trash-2"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#materiModal">
                                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> Tambah Sub
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kurikulumModal, #exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var kurikulumId = button.data('id'); // Extract info from data-* attributes

                console.log('Kurikulum ID:', kurikulumId);

                // Use the kurikulumId variable to set a hidden input field value
                $('#kurikulumIdInput').val(kurikulumId); // Assuming you have an input field with this ID
            });
        });
    </script>

@endsection
