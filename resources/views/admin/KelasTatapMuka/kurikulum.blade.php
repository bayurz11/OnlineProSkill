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
        @include('admin.modal.edit_clasroom')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kurikulum</h6>
                        <div class="d-flex justify-content-end">
                            @if ($courses)
                                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#kurikulumModal" data-id="{{ $courses->id }}">
                                    <i class="btn-icon-prepend" data-feather="plus-circle"></i> Kurikulum
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="btn-icon-prepend" data-feather="plus-circle"></i>
                                Sub
                            </button>
                        </div>
                        <p class="text-muted mb-3"> Jumlah Kurikulum : {{ $course->count() }}</p>
                        <div class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kurikulumModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang membuka modal
                var course_id = button.data('id'); // Ambil nilai dari atribut data-id
                var modal = $(this);
                modal.find('.modal-body input[name="course_id"]').val(
                    course_id); // Set nilai input course_id dalam modal
            });
        });
    </script>




@endsection
