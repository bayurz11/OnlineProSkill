@section('title', 'ProSkill Akademia | Admin Profil')
<?php $page = 'profil_admin'; ?>

@extends('layout.mainlayout_admin')

@section('content')
    <br><br>
    <div class="container mt-5">
        <!-- User Profile Form -->
        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                <img src="https://via.placeholder.com/30x30" alt="Profile Picture" class="rounded-circle border shadow-sm"
                    width="120" height="120">
                <label for="profile_picture"
                    class="position-absolute bottom-0 end-0 bg-primary text-white border rounded-circle p-3"
                    style="cursor: pointer; transform: translate(50%, 50%);">
                    <i class="me-2 icon-md" data-feather="camera"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                    <!-- Posisikan ikon di tengah -->
                </label>
                <input type="file" id="profile_picture" name="profile_picture" class="d-none">
            </div>
            <h5 class="mt-3">Profil Pengguna</h5>
        </div>


        <div class="card mb-4">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="row mb-3">
                        <label for="name" class="col-md-3 col-form-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="row mb-3">
                        <label for="email" class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ auth()->user()->email }}" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="row mb-3">
                        <label for="phone" class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ auth()->user()->phone ?? '' }}" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="row mb-3">
                        <label for="current_password" class="col-md-3 col-form-label">Current Password</label>
                        <div class="col-md-9">
                            <input type="password" name="current_password" id="current_password" class="form-control"
                                required>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="row mb-3">
                        <label for="new_password" class="col-md-3 col-form-label">New Password</label>
                        <div class="col-md-9">
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>
                    </div>

                    <!-- Confirm New Password -->
                    <div class="row mb-3">
                        <label for="new_password_confirmation" class="col-md-3 col-form-label">Confirm New Password</label>
                        <div class="col-md-9">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
