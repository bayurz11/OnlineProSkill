@section('title', 'ProSkill Akademia | Kategori')
<?php $page = 'main_categories'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>

        @include('admin.modal.add_categories')
        @include('admin.modal.edit_categories')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Kategori</h6>
                        <button type="button" class="btn btn-outline-primary position-absolute top-0 end-0 mt-3 me-3"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="btn-icon-prepend"
                                data-feather="plus-circle"></i>
                            Kategori
                        </button>
                        <p class="text-muted mb-3">Jumlah Kategori : </p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>System Architect</td>
                                        <td id="statusCell">active</td>
                                        <td>
                                            <button type="button" class="btn btn-primary">Edit</button>
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        // Mendapatkan elemen sel yang akan diubah
        var statusCell = document.getElementById("statusCell");

        // Mengatur nilai awal status
        var status = "active";

        // Menambahkan event listener untuk mengubah status saat sel diklik
        statusCell.addEventListener("click", function() {
            // Toggle status
            status = (status === "active") ? "inactive" : "active";
            // Memperbarui teks sel
            statusCell.textContent = status;
        });
    </script>
@endsection
