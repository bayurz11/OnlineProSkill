@section('title', 'ProSkill Akademia | Profil Setting')
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

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            @include('instruktur.nav.profile')

            <div class="row">
                @include('instruktur.nav.navbar')

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
                                                aria-controls="itemOne-tab-pane" aria-selected="true">Profile</button>
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
                                    <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                        aria-labelledby="itemOne-tab" tabindex="0">
                                        <div class="instructor__cover-bg"
                                            data-background="public/assets/img/bg/instructor_dashboard_bg.jpg">
                                            <div class="instructor__cover-info">
                                                <div class="instructor__cover-info-left">
                                                    <div class="thumb">
                                                        <img src="public/assets/img/courses/details_instructors01.jpg"
                                                            alt="img">
                                                    </div>
                                                    <button title="Upload Photo"><i class="fas fa-camera"></i></button>
                                                </div>
                                                <div class="instructor__cover-info-right">
                                                    <a href="#" class="btn btn-two arrow-btn">Edit Cover Photo</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="instructor__profile-form-wrap">
                                            <form action="{{ route('updateProfile', ['id' => $profile->id]) }}"
                                                class="instructor__profile-form"method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-grp">
                                                            <label for="name">Nama Lengkap</label>
                                                            <input id="name" type="text"
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
                                                <div class="submit-btn mt-25">
                                                    <button type="submit" class="btn">Update Info</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

@endsection
