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
        <div class="col-lg-12 px-4">
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
                                                    <label for="nama">Nama <span class="text-danger">*</span></label>
                                                    <input id="nama" name="nama" type="text"
                                                        placeholder="masukkan nama anda" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="phonenumber">Nomor Telepon <span
                                                            class="text-danger">*</span></label>
                                                    <input id="phonenumber" name="phonenumber" type="number" min="0"
                                                        placeholder="masukkan nomor telepon" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="email">Email</label>
                                                    <input id="lastname" type="email" placeholder="masukkan email anda"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="displayname">Peruntukan Training </label>
                                                    <select id="displayname" name="displayname">
                                                        <option>Pilih</option>
                                                        <option value="company">Company</option>
                                                        <option value="individu">Individu</option>
                                                        <option value="Kelompok_Kecil">Kelompok Kecil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp select-grp">
                                                    <label for="displayname">Berapa jumlah peserta yang ikut serta dalam
                                                        training?</label>
                                                    <select id="displayname" name="displayname">
                                                        <option>Pilih</option>
                                                        <option value="1-5">1-5 Orang</option>
                                                        <option value="6-10">6-10 Orang</option>
                                                        <option value="11-15">11-15 Orang</option>
                                                        <option value=">15">>15</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="username">User Name</label>
                                                    <input id="username" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="skill">Skill/Occupation</label>
                                                    <input id="skill" type="text" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-grp">
                                            <label for="bio">Bio</label>
                                            <textarea id="bio">I'm the Front-End Developer for #ThemeGenix in New York, OR. I am passionate about UI effects, animations, and creating intuitive, dynamic user experiences.</textarea>
                                        </div>
                                        <div class="submit-btn mt-25 d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn">Kirim Pesan</button>
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
