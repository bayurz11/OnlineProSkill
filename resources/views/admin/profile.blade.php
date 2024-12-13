@section('title', 'ProSkill Akademia | Admin Profil')
<?php $page = 'profil_admin'; ?>

@extends('layout.mainlayout_admin')

@section('content')
    <br><br><br>
    <div class="container mt-4">
        <!-- User Profile Form -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">User Profile</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="row mb-3">
                        <label for="name" class="col-md-3 col-form-label">Name</label>
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
                                value="{{ auth()->user()->phone }}">
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="row mb-3">
                        <label for="profile_picture" class="col-md-3 col-form-label">Profile Picture</label>
                        <div class="col-md-9">
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                            @if (auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row mb-3">
                        <label for="address" class="col-md-3 col-form-label">Address</label>
                        <div class="col-md-9">
                            <textarea name="address" id="address" class="form-control" rows="3">{{ auth()->user()->address }}</textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Form -->
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Change Password</h4>
            </div>
            <div class="card-body">
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
                        <button type="submit" class="btn btn-danger">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
