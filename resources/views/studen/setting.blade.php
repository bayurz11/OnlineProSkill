@section('title', 'ProSkill Akademia | Profil Saya')
<?php $page = 'index'; ?>

@extends('layout.mainlayout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="breadcrumb__area breadcrumb__bg breadcrumb__bg-three"
        data-background="public/assets/img/bg/breadcrumb_bg.jpg">
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg" data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                alt="img" width="120" height="120" style="object-fit: cover;">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    {{ $orders->count() }} Kelas
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                @include('studen.nav.nav')

                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title">Profil Saya</h4>
                            <p class="text">Informasi mengenai profil dan preferensi kamu di seluruh layanan ProSkill.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard__nav-wrap">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="itemOne-tab" data-bs-toggle="tab"
                                                data-bs-target="#itemOne-tab-pane" type="button" role="tab"
                                                aria-controls="itemOne-tab-pane" aria-selected="true">Profil</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="itemTwo-tab" data-bs-toggle="tab"
                                                data-bs-target="#itemTwo-tab-pane" type="button" role="tab"
                                                aria-controls="itemTwo-tab-pane" aria-selected="false">Kata Sandi</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                        aria-labelledby="itemOne-tab" tabindex="0">
                                        <form action="{{ route('updateProfile', ['id' => $profile->id]) }}"
                                            class="instructor__profile-form" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="instructor__cover-bg">
                                                <div class="instructor__cover-info">
                                                    <div class="instructor__cover-info-left"
                                                        onclick="document.getElementById('foto').click();">
                                                        <div class="thumb">
                                                            <img id="profileImage"
                                                                src="{{ $profile && $profile->gambar ? (strpos($profile->gambar, 'googleusercontent') !== false ? $profile->gambar : asset('public/uploads/' . $profile->gambar)) : asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                                alt="img" width="120" height="120"
                                                                style="object-fit: cover;">
                                                            <p>maksimal 2Mb</p>
                                                        </div>
                                                    </div>

                                                    <div class="instructor__cover-info-right">
                                                        <input type="file" id="foto" name="foto"
                                                            style="display: none;" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="instructor__profile-form-wrap">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-grp">
                                                            <label for="name">Nama Lengkap</label>
                                                            <input id="name" name="name" type="text"
                                                                value="{{ $user->name }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="dateofBirth">Tanggal Lahir<span
                                                                    style="color: red">*</span></label>
                                                            <input id="dateofBirth" name="dateofBirth" type="date"
                                                                value="{{ $profile->date_of_birth }}">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-grp select-grp">
                                                            <label for="gender">Gender<span
                                                                    style="color: red">*</span></label>
                                                            <select id="gender" name="gender">
                                                                <option>Pilih Gender</option>
                                                                <option value="Laki-Laki"
                                                                    {{ $profile->gender == 'Laki-Laki' ? 'selected' : '' }}>
                                                                    Laki-Laki</option>
                                                                <option value="Perempuan"
                                                                    {{ $profile->gender == 'Perempuan' ? 'selected' : '' }}>
                                                                    Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="phonenumber">No.HP<span
                                                                    style="color: red">*</span></label>
                                                            <input id="phonenumber" type="tel" name="phonenumber"
                                                                maxlength="12" value="{{ $profile->phone_number }}"
                                                                placeholder="08**********">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="alamat">Alamat <span
                                                                    style="color: red">*</span></label>
                                                            <input id="alamat" name="alamat" type="text"
                                                                value="{{ $profile->address }}"
                                                                placeholder="Masukkan alamat">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-grp">
                                                    <label for="bio">Bio</label>
                                                    <textarea id="bio" name="bio">{{ $profile->bio }}</textarea>
                                                </div> --}}
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Perbahrui Informasi</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="itemTwo-tab-pane" role="tabpanel"
                                        aria-labelledby="itemTwo-tab" tabindex="0">
                                        <div class="instructor__profile-form-wrap">
                                            <form action="{{ route('updatePassword', ['id' => $user->id]) }}"
                                                method="POST" enctype="multipart/form-data"
                                                class="instructor__profile-form">
                                                @csrf
                                                <div class="form-grp">
                                                    <label for="email">Email</label>
                                                    <input id="email" type="email" name="email"
                                                        value="{{ $user->email }}">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="password">Kata Sandi Baru</label>
                                                    <input id="password" type="password" name="password"
                                                        placeholder="kata sandi baru">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="password_confirmation">Ketik Ulang Kata Sandi Baru</label>
                                                    <input id="password_confirmation" name="password_confirmation"
                                                        type="password" placeholder="Ketik Ulang Kata Sandi Baru">
                                                </div>
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Perbahrui Kata Sandi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard-area-end -->

    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('profileImage');
                    img.src = e.target.result;
                    img.onload = function() {
                        // Set width and height attributes to 120x120
                        img.style.width = '120px';
                        img.style.height = '120px';
                        img.style.objectFit = 'cover'; // Optional: ensure the image covers the area
                    };
                };
                reader.readAsDataURL(file);
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById('dateofBirth');
            const today = new Date();
            const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate()).toISOString()
                .split('T')[0]; // Set minimum date to 100 years ago
            const maxDate = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate()).toISOString()
                .split('T')[0]; // Set maximum date to 5 years ago

            dateInput.setAttribute('min', minDate);
            dateInput.setAttribute('max', maxDate);
        });
    </script>
@endsection
