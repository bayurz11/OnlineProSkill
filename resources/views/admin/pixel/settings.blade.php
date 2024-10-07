@section('title', 'ProSkill Akademia | Facebook Setting')
<?php $page = 'contact'; ?>

@extends('layout.mainlayout_admin')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Facebook Setting</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Facebook Integration Setup</h6>

                        <form action="{{ route('pixel.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="pixel_id">Meta Pixel ID</label>
                                <input type="text" name="pixel_id" id="pixel_id" class="form-control"
                                    value="{{ old('pixel_id', $pixelId) }}" required>
                                @error('pixel_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <label for="api_token">Conversion API Access Token</label>
                                <input type="text" name="api_token" id="api_token" class="form-control"
                                    value="{{ old('api_token', $apiToken) }}" required>
                                @error('api_token')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




@endsection
