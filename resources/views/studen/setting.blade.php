@section('title', 'ProSkill Akademia | Setting')
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
                            <img src="{{ asset('public/assets/img/courses/details_instructors02.jpg') }}" alt="img">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ $user->name }}</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    5 Courses Enrolled
                                </li>
                                <li>
                                    <img src="{{ asset('public/assets/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    4 Certificate
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
                            <h4 class="title">Settings</h4>
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
                                                aria-controls="itemTwo-tab-pane" aria-selected="false">Password</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="itemThree-tab" data-bs-toggle="tab"
                                                data-bs-target="#itemThree-tab-pane" type="button" role="tab"
                                                aria-controls="itemThree-tab-pane" aria-selected="false">Social
                                                Share</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <form action="#" class="instructor__profile-form" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                            aria-labelledby="itemOne-tab" tabindex="0">
                                            <div class="instructor__cover-bg"
                                                data-background="{{ asset('public/assets/img/bg/student_bg.jpg') }}">
                                                <div class="instructor__cover-info">
                                                    <div class="instructor__cover-info-left">
                                                        <div class="thumb">
                                                            <img src="{{ asset('public/assets/img/courses/details_instructors02.jpg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div id="uploadContainer" class="upload-container"
                                                            title="Upload Photo">
                                                            <i class="fas fa-camera"></i>
                                                        </div>

                                                        <input type="file" id="fileInput" accept="image/*"
                                                            style="display: none;" webkitdirectory mozdirectory
                                                            directory />

                                                        <script>
                                                            document.getElementById('uploadContainer').addEventListener('click', function() {
                                                                document.getElementById('fileInput').click();
                                                            });

                                                            document.getElementById('fileInput').addEventListener('change', function(event) {
                                                                const files = event.target.files;
                                                                // Proses file yang dipilih di sini
                                                                console.log(files);
                                                            });
                                                        </script>
                                                    </div>
                                                    <div class="instructor__cover-info-right">
                                                        <a href="#" class="btn btn-two arrow-btn">Edit Foto
                                                            Sampul</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="instructor__profile-form-wrap">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="name">Nama Lengkap</label>
                                                            <input id="name" name="name" type="text"
                                                                value="{{ $user->name }}" readonly
                                                                style="background-color: #bebebe;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="email">Email</label>
                                                            <input id="email" name="email" type="email"
                                                                value="{{ $user->email }}" readonly
                                                                style="background-color: #bebebe;">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="phonenumber">Telepon<span
                                                                    style="color: red">*</span> </label>
                                                            <input id="phonenumber" type="tel" name="phonenumber"
                                                                value="" placeholder="masukan no telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-grp">
                                                            <label for="alamat">Alamat <span
                                                                    style="color: red">*</span></label>
                                                            <input id="alamat" name="alamat" type="text"
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-grp">
                                                    <label for="bio">Bio</label>
                                                    <textarea id="bio" name="bio"></textarea>
                                                </div>
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Perbahrui Informasi</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    <div class="tab-pane fade" id="itemTwo-tab-pane" role="tabpanel"
                                        aria-labelledby="itemTwo-tab" tabindex="0">
                                        <div class="instructor__profile-form-wrap">
                                            <form action="#" class="instructor__profile-form">
                                                <div class="form-grp">
                                                    <label for="currentpassword">Current Password</label>
                                                    <input id="currentpassword" type="password"
                                                        placeholder="Current Password">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="newpassword">New Password</label>
                                                    <input id="newpassword" type="password" placeholder="New Password">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="repassword">Re-Type New Password</label>
                                                    <input id="repassword" type="password"
                                                        placeholder="Re-Type New Password">
                                                </div>
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Update Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="itemThree-tab-pane" role="tabpanel"
                                        aria-labelledby="itemThree-tab" tabindex="0">
                                        <div class="instructor__profile-form-wrap">
                                            <form action="#" class="instructor__profile-form">
                                                <div class="form-grp">
                                                    <label for="facebook">Facebook</label>
                                                    <input id="facebook" type="url"
                                                        placeholder="https://facebook.com/">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="twitter">Twitter</label>
                                                    <input id="twitter" type="url"
                                                        placeholder="https://twitter.com/">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="linkedin">Linkedin</label>
                                                    <input id="linkedin" type="url"
                                                        placeholder="https://linkedin.com/">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="website">Website</label>
                                                    <input id="website" type="url"
                                                        placeholder="https://website.com/">
                                                </div>
                                                <div class="form-grp">
                                                    <label for="github">Github</label>
                                                    <input id="github" type="url"
                                                        placeholder="https://github.com/">
                                                </div>
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Update Profile</button>
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
    <style>
        /* Styling untuk elemen upload */
        .upload-container {
            display: inline-block;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
        }

        .upload-container i {
            font-size: 24px;
        }
    </style>
@endsection
