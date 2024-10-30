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
    <div class="row">

        <div class="col-lg-12 ">
            <div class="dashboard__content-wrap">
                <div class="dashboard__content-title text-center">
                    <h4 class="title">Leave a Message</h4>
                    <p>Jika kamu masih bingung memilih materi dan kelas yang sesuai atau ingin mendapatkan penawaran untuk
                        training corporate dll, silahkan isi form berikut:</p>
                </div>
                <div class="row">
                    <div class="col-lg-12 ml-6 mr-6">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="itemOne-tab-pane" role="tabpanel"
                                aria-labelledby="itemOne-tab" tabindex="0">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
