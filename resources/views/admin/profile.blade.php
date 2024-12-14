<?php $page = 'profil_admin'; ?>

@extends('layout.mainlayout_admin')

@section('title', 'ProSkill Akademia | Admin Profil')

@section('content')
    <br><br>
    <div class="container mt-5">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- User Profile Form -->
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block"
                    style="width: 120px; height: 120px; overflow: hidden; border-radius: 50%; border: 1px solid #dee2e6; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                    <img id="profile_preview"
                        src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                        alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                    <label for="profile_picture" class="position-absolute"
                        style="bottom: 5px; right: 5px; transform: translateX(-50%); background-color: #007bff; color: #fff; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                        <i data-feather="camera" style="width: 16px; height: 16px;"></i>
                    </label>
                    <input type="file" id="profile_picture" name="foto" class="d-none"
                        accept="image/png, image/jpeg, image/jpg">
                </div>
                <h5 class="mt-3">Profil Pengguna</h5>
            </div>

            <div class="card mb-4">
                <div class="card-body">
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
                                value="{{ auth()->user()->email }}" required readonly>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="row mb-3">
                        <label for="phone_number" class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                value="{{ $profile->phone_number ?? '' }}">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Change Password Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                <form action="{{ route('admin.password.update', ['id' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- New Password -->
                    <div class="row mb-3">
                        <label for="password" class="col-md-3 col-form-label">New Password</label>
                        <div class="col-md-9 position-relative">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button"
                                class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                                onclick="togglePasswordVisibility('password', this)">
                                <i class="link-icon" data-feather="eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm New Password -->
                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-md-3 col-form-label">Confirm New Password</label>
                        <div class="col-md-9 position-relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                            <button type="button"
                                class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                                onclick="togglePasswordVisibility('password_confirmation', this)">
                                <i class="link-icon" data-feather="eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function togglePasswordVisibility(fieldId, button) {
                const field = document.getElementById(fieldId);
                const icon = button.querySelector('i');

                if (field.type === 'password') {
                    field.type = 'text';
                    icon.setAttribute('data-feather', 'eye-off');
                } else {
                    field.type = 'password';
                    icon.setAttribute('data-feather', 'eye');
                }
                // Re-render feather icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        </script>

    </div>

    <script>
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imgElement = document.getElementById('profile_preview');

            if (file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                if (!allowedTypes.includes(file.type)) {
                    alert('Hanya file gambar dengan format JPG, JPEG, atau PNG yang diperbolehkan.');
                    event.target.value = ''; // Reset input file
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    imgElement.src = e.target.result; // Mengubah src elemen img dengan hasil pratinjau
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
