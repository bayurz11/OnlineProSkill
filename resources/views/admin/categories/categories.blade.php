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
                                        <th>Gambar Icon</th>
                                        <th>Nama Kategori</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        {{--  {{ asset('public/uploads/' . $heroSection->banner) }} --}}
                                        <td><img src="#" alt="Banner" class="wd-100 wd-sm-150 me-3"></td>
                                        <td>System Architect</td>
                                        <td><a href="#" id="badgeLink" class="badge bg-success">Active</a></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-icon edit-button"
                                                title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="#">
                                                <i data-feather="edit"></i>
                                            </button>

                                            <button onclick="#" class="btn btn-danger btn-icon" title="Hapus">
                                                <i data-feather="trash-2"></i>
                                            </button>
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
        var badgeLink = document.getElementById("badgeLink");

        badgeLink.addEventListener("click", function() {

            if (badgeLink.classList.contains("bg-success")) {
                badgeLink.classList.remove("bg-success");
                badgeLink.classList.add("bg-danger");
                // Perbarui teks
                badgeLink.textContent = "Inactive";
            } else {
                badgeLink.classList.remove("bg-danger");
                badgeLink.classList.add("bg-success");
                // Perbarui teks
                badgeLink.textContent = "Active";
            }
        });
    </script>
@endsection
