@section('title', 'ProSkill Akademia | In-house Training Formulir')
<?php $page = 'Tentang_Kami'; ?>

@extends('layout.mainlayout')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="public/assets/img/bg/breadcrumb_bg.jpg" loading="lazy">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Tinggalkan pesan</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('/') }}">Beranda</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">In-house Training Form</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="public/assets/img/others/breadcrumb_shape01.svg" alt="img" class="alltuchtopdown" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape02.svg" alt="img" data-aos="fade-right"
                data-aos-delay="300" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape03.svg" alt="img" data-aos="fade-up"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape04.svg" alt="img" data-aos="fade-down-left"
                data-aos-delay="400" loading="lazy">
            <img src="public/assets/img/others/breadcrumb_shape05.svg" alt="img" data-aos="fade-left"
                data-aos-delay="400" loading="lazy">
        </div>
    </section>
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
                                    aria-controls="itemThree-tab-pane" aria-selected="false">Social Share</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                            aria-labelledby="itemOne-tab" tabindex="0">
                            <div class="instructor__cover-bg" data-background="assets/img/bg/instructor_dashboard_bg.jpg">
                                <div class="instructor__cover-info">
                                    <div class="instructor__cover-info-left">
                                        <div class="thumb">
                                            <img src="assets/img/courses/details_instructors01.jpg" alt="img">
                                        </div>
                                        <button title="Upload Photo"><i class="fas fa-camera"></i></button>
                                    </div>
                                    <div class="instructor__cover-info-right">
                                        <a href="#" class="btn btn-two arrow-btn">Edit Cover Photo</a>
                                    </div>
                                </div>
                            </div>
                            <div class="instructor__profile-form-wrap">
                                <form action="#" class="instructor__profile-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="firstname">First Name</label>
                                                <input id="firstname" type="text" value="John">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="lastname">Last Name</label>
                                                <input id="lastname" type="text" value="Due">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="username">User Name</label>
                                                <input id="username" type="text" value="johndue">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="phonenumber">Phone Number</label>
                                                <input id="phonenumber" type="tel" value="+1-202-555-0174">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp">
                                                <label for="skill">Skill/Occupation</label>
                                                <input id="skill" type="text" value="Full Stack Developer">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-grp select-grp">
                                                <label for="displayname">Display Name Publicly As</label>
                                                <select id="displayname" name="displayname">
                                                    <option value="Emily Hannah">Emily Hannah</option>
                                                    <option value="John">John</option>
                                                    <option value="Due">Due</option>
                                                    <option value="Due John">Due John</option>
                                                    <option value="johndue">johndue</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-grp">
                                        <label for="bio">Bio</label>
                                        <textarea id="bio">I'm the Front-End Developer for #ThemeGenix in New York, OR. I am passionate about UI effects, animations, and creating intuitive, dynamic user experiences.</textarea>
                                    </div>
                                    <div class="submit-btn mt-25">
                                        <button type="submit" class="btn">Update Info</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="itemTwo-tab-pane" role="tabpanel" aria-labelledby="itemTwo-tab"
                            tabindex="0">
                            <div class="instructor__profile-form-wrap">
                                <form action="#" class="instructor__profile-form">
                                    <div class="form-grp">
                                        <label for="currentpassword">Current Password</label>
                                        <input id="currentpassword" type="password" placeholder="Current Password">
                                    </div>
                                    <div class="form-grp">
                                        <label for="newpassword">New Password</label>
                                        <input id="newpassword" type="password" placeholder="New Password">
                                    </div>
                                    <div class="form-grp">
                                        <label for="repassword">Re-Type New Password</label>
                                        <input id="repassword" type="password" placeholder="Re-Type New Password">
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
                                        <input id="facebook" type="url" placeholder="https://facebook.com/">
                                    </div>
                                    <div class="form-grp">
                                        <label for="twitter">Twitter</label>
                                        <input id="twitter" type="url" placeholder="https://twitter.com/">
                                    </div>
                                    <div class="form-grp">
                                        <label for="linkedin">Linkedin</label>
                                        <input id="linkedin" type="url" placeholder="https://linkedin.com/">
                                    </div>
                                    <div class="form-grp">
                                        <label for="website">Website</label>
                                        <input id="website" type="url" placeholder="https://website.com/">
                                    </div>
                                    <div class="form-grp">
                                        <label for="github">Github</label>
                                        <input id="github" type="url" placeholder="https://github.com/">
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
@endsection
